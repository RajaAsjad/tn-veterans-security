<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceBooking;
use App\Models\ClassSchedule;
use App\Models\Payment;
use App\Services\QuickBooksService;
use App\Services\BankIntegrationService;
use App\Services\SquareService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Show customer's bookings list.
     */
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $bookings = ServiceBooking::where('customer_id', $customer->id)
            ->with(['service', 'classSchedule'])
            ->orderBy('booking_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('customer.bookings', compact('bookings'));
    }

    /**
     * Show available classes for a service.
     */
    public function showAvailableClasses($serviceId)
    {
        $service = Service::where('is_active', true)->findOrFail($serviceId);
        
        // Get available class schedules
        $schedules = ClassSchedule::where('service_id', $service->id)
            ->where('status', 'scheduled')
            ->where('class_date', '>=', now()->toDateString())
            ->whereRaw('current_students < max_students')
            ->orderBy('class_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();
        
        return view('customer.available-classes', compact('service', 'schedules'));
    }

    /**
     * Show checkout: booking summary and payment step (from service-details inquiry).
     */
    public function showCheckout($serviceId)
    {
        $service = Service::where('is_active', true)->findOrFail($serviceId);
        $inquiry = session('booking_inquiry_' . $service->id);
        if (! $inquiry) {
            return redirect()->route('service.details', $service->id)
                ->with('error', 'Please complete the booking form first.');
        }
        $numStudents = (int) ($inquiry['number_of_students'] ?? 1);
        $totalAmount = ($service->price ?? 0) * $numStudents;
        $depositAmount = ($service->deposit_amount ?? 0) * $numStudents;
        $amountDue = $depositAmount > 0 ? $depositAmount : $totalAmount;
        $isLoggedIn = Auth::guard('customer')->check();
        if (! $isLoggedIn) {
            session()->put('url.intended', route('customer.services.checkout', $service->id));
        }
        return view('customer.checkout', compact('service', 'inquiry', 'amountDue', 'totalAmount', 'depositAmount', 'numStudents', 'isLoggedIn'));
    }

    /**
     * Process checkout: create booking from inquiry and redirect to payment.
     */
    public function processCheckout(Request $request, $serviceId)
    {
        $customer = Auth::guard('customer')->user();
        $service = Service::where('is_active', true)->findOrFail($serviceId);
        $inquiry = session('booking_inquiry_' . $service->id);
        if (! $inquiry) {
            return redirect()->route('service.details', $service->id)
                ->with('error', 'Session expired. Please complete the booking form again.');
        }
        $numStudents = (int) ($inquiry['number_of_students'] ?? 1);
        $preferredDate = $inquiry['preferred_date'] ?? null;
        $preferredLocation = $inquiry['location'] ?? null;

        $totalAmount = ($service->price ?? 0) * $numStudents;
        $depositAmount = ($service->deposit_amount ?? 0) * $numStudents;
        $remainingAmount = $totalAmount - $depositAmount;

        $bookingDate = $preferredDate ? \Carbon\Carbon::parse($preferredDate)->toDateString() : now()->toDateString();
        $location = ($preferredLocation && $preferredLocation !== 'Any location' && $preferredLocation !== 'No Specific Location')
            ? $preferredLocation
            : null;

        DB::beginTransaction();
        try {
            $booking = ServiceBooking::create([
                'customer_id' => $customer->id,
                'service_id' => $service->id,
                'class_schedule_id' => null,
                'location' => $location,
                'booking_date' => $bookingDate,
                'booking_time' => null,
                'status' => 'pending',
                'booking_type' => $service->class_type ?? 'group',
                'number_of_students' => $numStudents,
                'group_name' => $inquiry['name'] ?? null,
                'notes' => null,
                'total_amount' => $totalAmount,
                'deposit_amount' => $depositAmount,
                'remaining_amount' => $remainingAmount,
                'payment_status' => 'pending',
            ]);
            DB::commit();
            return redirect()->route('customer.booking.payment', $booking->id)
                ->with('success', 'Please complete payment for your booking.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.services.checkout', $service->id)
                ->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Show booking form for a specific class schedule.
     */
    public function create($serviceId, $scheduleId = null)
    {
        $service = Service::where('is_active', true)->findOrFail($serviceId);
        $customer = Auth::guard('customer')->user();
        
        $schedule = null;
        if ($scheduleId) {
            $schedule = ClassSchedule::where('service_id', $service->id)
                ->where('id', $scheduleId)
                ->firstOrFail();
            
            // Check if schedule has available spots
            if (!$schedule->hasAvailableSpots()) {
                return redirect()->route('customer.available-classes', $service->id)
                    ->with('error', 'This class is full. Please select another schedule.');
            }
        }
        
        // Get available schedules if no specific schedule selected
        if (!$schedule) {
            $schedules = ClassSchedule::where('service_id', $service->id)
                ->where('status', 'scheduled')
                ->where('class_date', '>=', now()->toDateString())
                ->whereRaw('current_students < max_students')
                ->orderBy('class_date', 'asc')
                ->orderBy('start_time', 'asc')
                ->get();
        } else {
            $schedules = collect([$schedule]);
        }
        
        return view('customer.create-booking', compact('service', 'schedules', 'schedule', 'customer'));
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'class_schedule_id' => 'required|exists:class_schedules,id',
            'number_of_students' => 'required|integer|min:1|max:10',
            'group_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Get service and schedule
        $service = Service::findOrFail($validated['service_id']);
        $schedule = ClassSchedule::findOrFail($validated['class_schedule_id']);
        
        // Validate capacity
        $availableSpots = $schedule->getAvailableSpots();
        if ($validated['number_of_students'] > $availableSpots) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Only {$availableSpots} spot(s) available. Please adjust the number of students.");
        }
        
        // Validate minimum students if it's a group booking
        if ($service->class_type === 'group' && $validated['number_of_students'] < $schedule->min_students) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Minimum {$schedule->min_students} student(s) required for this class.");
        }
        
        // Calculate amounts
        $totalAmount = $service->price * $validated['number_of_students'];
        $depositAmount = $service->deposit_amount * $validated['number_of_students'];
        $remainingAmount = $totalAmount - $depositAmount;

        // Create booking in transaction
        DB::beginTransaction();
        try {
            // Create booking
            $booking = ServiceBooking::create([
                'customer_id' => $customer->id,
                'service_id' => $service->id,
                'class_schedule_id' => $schedule->id,
                'location' => $schedule->location, // Store location from schedule
                'booking_date' => $schedule->class_date,
                'booking_time' => Carbon::parse($schedule->start_time)->format('H:i:s'),
                'status' => 'pending',
                'booking_type' => $service->class_type,
                'number_of_students' => $validated['number_of_students'],
                'group_name' => $validated['group_name'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'total_amount' => $totalAmount,
                'deposit_amount' => $depositAmount,
                'remaining_amount' => $remainingAmount,
                'payment_status' => 'pending',
            ]);

            // Update schedule student count
            $schedule->increment('current_students', $validated['number_of_students']);
            
            // Check if class is now full
            if ($schedule->current_students >= $schedule->max_students) {
                $schedule->update(['status' => 'full']);
            }

            DB::commit();
            
            // Redirect to payment page
            return redirect()->route('customer.booking.payment', $booking->id)
                ->with('success', 'Booking created successfully. Please complete your deposit payment.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Show deposit payment page.
     */
    public function showPayment($bookingId)
    {
        $customer = Auth::guard('customer')->user();
        $booking = ServiceBooking::where('customer_id', $customer->id)
            ->with(['service', 'classSchedule'])
            ->findOrFail($bookingId);
        
        // Check if deposit already paid
        if ($booking->payment_status === 'deposit_paid' || $booking->payment_status === 'fully_paid') {
            return redirect()->route('customer.bookings.show', $booking->id)
                ->with('info', 'Deposit has already been paid.');
        }
        
        $squareService = app(SquareService::class);
        $squareEnabled = $squareService->isEnabled();
        $squareAppId = $squareService->getApplicationId();
        $squareLocationId = $squareService->getLocationId();
        $squareScriptUrl = $squareService->getWebPaymentsScriptUrl();

        return view('customer.booking-payment', compact(
            'booking',
            'squareEnabled',
            'squareAppId',
            'squareLocationId',
            'squareScriptUrl'
        ));
    }

    /**
     * Process deposit payment via Square (card).
     */
    public function processSquarePayment(Request $request, $bookingId)
    {
        $customer = Auth::guard('customer')->user();
        $booking = ServiceBooking::where('customer_id', $customer->id)
            ->findOrFail($bookingId);

        if ($booking->payment_status === 'deposit_paid' || $booking->payment_status === 'fully_paid') {
            return redirect()->route('customer.bookings.show', $booking->id)
                ->with('info', 'Deposit has already been paid.');
        }

        $request->validate(['nonce' => 'required|string']);

        $squareService = app(SquareService::class);
        if (!$squareService->isEnabled()) {
            return redirect()->route('customer.booking.payment', $booking->id)
                ->with('error', 'Card payments are not available. Please try another method.');
        }

        // When deposit is $0, charge total_amount (full payment) instead
        $chargeAmount = ($booking->deposit_amount > 0) ? $booking->deposit_amount : $booking->total_amount;
        if ($chargeAmount <= 0) {
            return redirect()->route('customer.booking.payment', $booking->id)
                ->with('error', 'No amount to charge.');
        }

        $amountCents = (int) round($chargeAmount * 100);
        $idempotencyKey = 'booking-' . $booking->id . '-' . uniqid();

        $result = $squareService->createPayment(
            $request->nonce,
            $amountCents,
            $idempotencyKey,
            'Booking#' . $booking->id
        );

        if (!$result['success']) {
            return redirect()->route('customer.booking.payment', $booking->id)
                ->with('error', 'Payment failed: ' . ($result['message'] ?? 'Please try again.'));
        }

        $isFullPayment = $chargeAmount >= $booking->total_amount;
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'customer_id' => $customer->id,
            'amount' => $chargeAmount,
            'payment_type' => $isFullPayment ? 'full_payment' : 'deposit',
            'payment_method' => 'credit_card',
            'transaction_id' => $result['square_payment_id'],
            'payment_gateway' => 'square',
            'gateway_response' => ['square_payment_id' => $result['square_payment_id']],
            'status' => 'completed',
            'payment_date' => now(),
        ]);

        $booking->update([
            'payment_status' => $isFullPayment ? 'fully_paid' : 'deposit_paid',
            'status' => 'confirmed',
        ]);

        if ($payment->status === 'completed') {
            try {
                $quickBooksService = app(QuickBooksService::class);
                $quickBooksResult = $quickBooksService->syncPayment($payment);
                if (!$quickBooksResult['success']) {
                    Log::warning('QuickBooks auto-sync failed', ['payment_id' => $payment->id, 'error' => $quickBooksResult['message']]);
                }
            } catch (\Exception $e) {
                Log::error('QuickBooks auto-sync exception', ['payment_id' => $payment->id, 'error' => $e->getMessage()]);
            }
            try {
                $bankService = app(BankIntegrationService::class);
                $bankResult = $bankService->syncPayment($payment);
                if (!$bankResult['success']) {
                    Log::warning('Bank auto-sync failed', ['payment_id' => $payment->id, 'error' => $bankResult['message']]);
                }
            } catch (\Exception $e) {
                Log::error('Bank auto-sync exception', ['payment_id' => $payment->id, 'error' => $e->getMessage()]);
            }
        }

        return redirect()->route('customer.bookings.show', $booking->id)
            ->with('success', 'Deposit payment received. Your booking is confirmed!');
    }

    /**
     * Process deposit payment.
     */
    public function processPayment(Request $request, $bookingId)
    {
        $customer = Auth::guard('customer')->user();
        $booking = ServiceBooking::where('customer_id', $customer->id)
            ->findOrFail($bookingId);
        
        $validated = $request->validate([
            'payment_method' => 'required|in:credit_card,bank_transfer,cash',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        // Create payment record
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'customer_id' => $customer->id,
            'amount' => $booking->deposit_amount,
            'payment_type' => 'deposit',
            'payment_method' => $validated['payment_method'],
            'transaction_id' => $validated['transaction_id'] ?? null,
            'status' => $validated['payment_method'] === 'cash' ? 'pending' : 'completed',
            'payment_date' => now(),
        ]);

        // Update booking payment status
        $booking->update([
            'payment_status' => 'deposit_paid',
            'status' => 'confirmed',
        ]);

        // Auto-sync to QuickBooks and Bank if enabled (only for completed payments)
        if ($payment->status === 'completed') {
            try {
                // Sync to QuickBooks
                $quickBooksService = app(QuickBooksService::class);
                $quickBooksResult = $quickBooksService->syncPayment($payment);
                if (!$quickBooksResult['success']) {
                    Log::warning('QuickBooks auto-sync failed', [
                        'payment_id' => $payment->id,
                        'error' => $quickBooksResult['message'],
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('QuickBooks auto-sync exception', [
                    'payment_id' => $payment->id,
                    'error' => $e->getMessage(),
                ]);
            }

            try {
                // Sync to Bank
                $bankService = app(BankIntegrationService::class);
                $bankResult = $bankService->syncPayment($payment);
                if (!$bankResult['success']) {
                    Log::warning('Bank auto-sync failed', [
                        'payment_id' => $payment->id,
                        'error' => $bankResult['message'],
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Bank auto-sync exception', [
                    'payment_id' => $payment->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return redirect()->route('customer.bookings.show', $booking->id)
            ->with('success', 'Deposit payment received. Your booking is confirmed!');
    }

    /**
     * Show booking details.
     */
    public function show($id)
    {
        $customer = Auth::guard('customer')->user();
        $booking = ServiceBooking::where('customer_id', $customer->id)
            ->with(['service', 'classSchedule', 'payments'])
            ->findOrFail($id);
        
        return view('customer.booking-details', compact('booking'));
    }
}

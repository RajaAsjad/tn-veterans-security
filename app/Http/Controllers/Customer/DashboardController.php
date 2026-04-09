<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ServiceBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Middleware handles authentication, so we can safely get the user
        $customer = Auth::guard('customer')->user();
        
        // Get bookings with proper relationships
        $bookings = ServiceBooking::where('customer_id', $customer->id)
            ->with(['service', 'classSchedule'])
            ->orderBy('booking_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Filter upcoming bookings (pending or confirmed)
        $upcomingBookings = $bookings->filter(function($booking) {
            return in_array($booking->status, ['pending', 'confirmed']);
        })->take(3);
        
        // Get recent bookings
        $recentBookings = $bookings->take(5);

        $bookingDates = $bookings
            ->filter(function ($b) {
                return $b->booking_date
                    && in_array($b->status, ['pending', 'confirmed'], true);
            })
            ->groupBy(fn ($b) => $b->booking_date->format('Y-m-d'));

        $gridStart = now()->copy()->startOfMonth()->startOfWeek(Carbon::SUNDAY);
        $gridEnd = now()->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);
        $calendarWeeks = [];
        $cursor = $gridStart->copy();
        while ($cursor->lte($gridEnd)) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $ds = $cursor->format('Y-m-d');
                $week[] = [
                    'day' => $cursor->day,
                    'dateStr' => $ds,
                    'inMonth' => $cursor->month === now()->month,
                    'bookings' => $bookingDates->get($ds, collect()),
                ];
                $cursor->addDay();
            }
            $calendarWeeks[] = $week;
        }

        $calendarTitle = now()->format('F Y');

        return view('customer.dashboard', compact(
            'customer',
            'bookings',
            'upcomingBookings',
            'recentBookings',
            'calendarWeeks',
            'calendarTitle'
        ));
    }
}

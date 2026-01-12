<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $bookings = ServiceBooking::where('customer_id', $customer->id)
            ->with('service')
            ->orderBy('booking_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('customer.bookings', compact('bookings'));
    }

    public function show($id)
    {
        $customer = Auth::guard('customer')->user();
        $booking = ServiceBooking::where('customer_id', $customer->id)
            ->with('service')
            ->findOrFail($id);
        
        return view('customer.booking-details', compact('booking'));
    }
}

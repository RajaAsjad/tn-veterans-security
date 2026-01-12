<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $bookings = ServiceBooking::where('customer_id', $customer->id)
            ->with('service')
            ->orderBy('booking_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $upcomingBookings = $bookings->whereIn('status', ['pending', 'confirmed'])->take(3);
        $recentBookings = $bookings->take(5);
        
        return view('customer.dashboard', compact('customer', 'bookings', 'upcomingBookings', 'recentBookings'));
    }
}

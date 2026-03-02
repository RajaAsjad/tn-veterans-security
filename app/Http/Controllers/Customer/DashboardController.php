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
        
        return view('customer.dashboard', compact('customer', 'bookings', 'upcomingBookings', 'recentBookings'));
    }
}

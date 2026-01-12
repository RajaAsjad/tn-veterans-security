@extends('customer.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600 mt-2">Welcome back, {{ $customer->name }}!</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Bookings Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Bookings</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $bookings->count() }}</p>
            </div>
            <div class="bg-blue-100 p-4 rounded-full">
                <i class="fas fa-calendar-check text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Pending Bookings Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Pending Bookings</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $bookings->where('status', 'pending')->count() }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-full">
                <i class="fas fa-clock text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Confirmed Bookings Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Confirmed Bookings</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $bookings->where('status', 'confirmed')->count() }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-full">
                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Upcoming Bookings -->
@if($upcomingBookings->count() > 0)
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Upcoming Bookings</h2>
    <div class="space-y-4">
        @foreach($upcomingBookings as $booking)
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $booking->service->title }}</h3>
                    <p class="text-gray-600 mt-1">
                        <i class="fas fa-calendar mr-2"></i>{{ $booking->booking_date->format('M d, Y') }}
                        @if($booking->booking_time)
                            <i class="fas fa-clock ml-4 mr-2"></i>{{ $booking->booking_time->format('h:i A') }}
                        @endif
                    </p>
                    <span class="inline-block mt-2 px-3 py-1 rounded-full text-sm font-semibold
                        @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($booking->status == 'confirmed') bg-green-100 text-green-800
                        @elseif($booking->status == 'completed') bg-blue-100 text-blue-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
                <a href="{{ route('customer.bookings.show', $booking->id) }}" class="ml-4 hover:underline transition-colors" style="color: #3AA62C;" onmouseover="this.style.color='#175B0E'" onmouseout="this.style.color='#3AA62C'">
                    View Details <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Recent Bookings -->
@if($bookings->count() > 0)
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Recent Bookings</h2>
        <a href="{{ route('customer.bookings') }}" class="hover:underline transition-colors" style="color: #3AA62C;" onmouseover="this.style.color='#175B0E'" onmouseout="this.style.color='#3AA62C'">
            View All <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($recentBookings as $booking)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $booking->service->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $booking->booking_date->format('M d, Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($booking->status == 'confirmed') bg-green-100 text-green-800
                            @elseif($booking->status == 'completed') bg-blue-100 text-blue-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('customer.bookings.show', $booking->id) }}" class="transition-colors" style="color: #3AA62C;" onmouseover="this.style.color='#175B0E'" onmouseout="this.style.color='#3AA62C'">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="bg-white rounded-lg shadow p-12 text-center">
    <div class="max-w-md mx-auto">
        <i class="fas fa-calendar-times text-6xl text-gray-400 mb-4"></i>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">No Bookings Yet</h3>
        <p class="text-gray-600 mb-6">You haven't booked any services yet. Start by exploring our training services.</p>
        <a href="{{ route('services') }}" class="inline-block text-white font-bold py-3 px-6 rounded transition-colors shadow-md" style="background-color: #3AA62C;" onmouseover="this.style.backgroundColor='#175B0E'" onmouseout="this.style.backgroundColor='#3AA62C'">
            Browse Services
        </a>
    </div>
</div>
@endif
@endsection

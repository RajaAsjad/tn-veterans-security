@extends('customer.layouts.master')

@section('title', 'Booking Details')

@section('content')
<div class="mb-6">
    <a href="{{ route('customer.bookings') }}" class="hover:underline inline-flex items-center gap-2 mb-4 transition-colors" style="color: #3AA62C;" onmouseover="this.style.color='#175B0E'" onmouseout="this.style.color='#3AA62C'">
        <i class="fas fa-arrow-left"></i> Back to Bookings
    </a>
    <h1 class="text-3xl font-bold text-gray-800">Booking Details</h1>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">{{ $booking->service->title }}</h2>
            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full
                @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                @elseif($booking->status == 'confirmed') bg-green-100 text-green-800
                @elseif($booking->status == 'completed') bg-blue-100 text-blue-800
                @else bg-red-100 text-red-800
                @endif">
                {{ ucfirst($booking->status) }}
            </span>
        </div>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Service Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Service Information</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Service Name</p>
                        <p class="text-base font-medium text-gray-900">{{ $booking->service->title }}</p>
                    </div>
                    @if($booking->service->short_description)
                    <div>
                        <p class="text-sm text-gray-500">Description</p>
                        <p class="text-base text-gray-700">{{ $booking->service->short_description }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Booking Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Booking Information</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Booking Date</p>
                        <p class="text-base font-medium text-gray-900">{{ $booking->booking_date->format('F d, Y') }}</p>
                    </div>
                    @if($booking->booking_time)
                    <div>
                        <p class="text-sm text-gray-500">Booking Time</p>
                        <p class="text-base font-medium text-gray-900">{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm text-gray-500">Booked On</p>
                        <p class="text-base font-medium text-gray-900">{{ $booking->created_at->format('F d, Y h:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Last Updated</p>
                        <p class="text-base font-medium text-gray-900">{{ $booking->updated_at->format('F d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($booking->notes)
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Notes</h3>
            <p class="text-base text-gray-700 whitespace-pre-wrap">{{ $booking->notes }}</p>
        </div>
        @endif

        <div class="mt-6 pt-6 border-t border-gray-200">
            <a href="{{ route('services') }}" class="inline-block text-white font-bold py-3 px-6 rounded transition-colors shadow-md" style="background-color: #3AA62C;" onmouseover="this.style.backgroundColor='#175B0E'" onmouseout="this.style.backgroundColor='#3AA62C'">
                Browse More Services
            </a>
        </div>
    </div>
</div>
@endsection

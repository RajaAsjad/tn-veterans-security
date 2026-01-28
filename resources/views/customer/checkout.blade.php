@extends('customer.layouts.master')

@section('title', 'Checkout - ' . $service->title)

@section('content')
<div class="mb-6">
    <a href="{{ route('service.details', $service->id) }}" class="text-blue-600 hover:underline inline-flex items-center gap-2 mb-4">
        <i class="fas fa-arrow-left"></i> Back to Service
    </a>
</div>

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Complete your booking</h1>
    <p class="text-gray-600">{{ $service->title }}</p>
</div>

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Booking summary -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Booking details</h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Name:</span>
                    <span class="font-semibold text-gray-900">{{ $inquiry['name'] ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Email:</span>
                    <span class="font-semibold text-gray-900">{{ $inquiry['email'] ?? '-' }}</span>
                </div>
                @if(!empty($inquiry['phone']))
                <div class="flex justify-between">
                    <span class="text-gray-600">Phone:</span>
                    <span class="font-semibold text-gray-900">{{ $inquiry['phone'] }}</span>
                </div>
                @endif
                <div class="flex justify-between">
                    <span class="text-gray-600">Number of students:</span>
                    <span class="font-semibold text-gray-900">{{ $numStudents }}</span>
                </div>
                @if(!empty($inquiry['preferred_date']))
                <div class="flex justify-between">
                    <span class="text-gray-600">Preferred date:</span>
                    <span class="font-semibold text-gray-900">{{ date('M j, Y', strtotime($inquiry['preferred_date'])) }}</span>
                </div>
                @endif
                @if(!empty($inquiry['location']) && $inquiry['location'] !== 'Any location')
                <div class="flex justify-between">
                    <span class="text-gray-600">Location:</span>
                    <span class="font-semibold text-gray-900">{{ $inquiry['location'] }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Payment step -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow p-6 sticky top-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Payment</h3>
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4">
                <div class="text-sm text-gray-600 mb-1">Amount due</div>
                <div class="text-2xl font-bold text-gray-900">${{ number_format($amountDue, 2) }}</div>
                @if($depositAmount > 0 && $depositAmount < $totalAmount)
                <div class="text-xs text-gray-500 mt-1">Deposit · Total ${{ number_format($totalAmount, 2) }}</div>
                @endif
            </div>

            @if($isLoggedIn)
                <form method="POST" action="{{ route('customer.services.checkout.process', $service->id) }}">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-lock"></i> Proceed to payment
                    </button>
                </form>
                <p class="text-xs text-gray-500 mt-3">You will complete payment on the next step.</p>
            @else
                <p class="text-gray-600 text-sm mb-4">Log in or register to complete payment for this booking.</p>
                <div class="space-y-3">
                    <a href="{{ route('customer.login') }}" class="block w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-center transition-colors">
                        Log in to pay
                    </a>
                    <a href="{{ route('customer.register') }}" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg text-center transition-colors">
                        Create account
                    </a>
                </div>
                <p class="text-xs text-gray-500 mt-3">After logging in you will return here to complete payment.</p>
            @endif
        </div>
    </div>
</div>
@endsection

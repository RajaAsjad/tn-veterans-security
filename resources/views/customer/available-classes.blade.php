@extends('customer.layouts.master')

@section('title', 'Available Classes - ' . $service->title)

@section('content')
<div class="mb-6">
    <a href="{{ route('service.details', $service->id) }}" class="text-blue-600 hover:underline inline-flex items-center gap-2 mb-4">
        <i class="fas fa-arrow-left"></i> Back to Service Details
    </a>
</div>

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $service->title }}</h1>
    @if($service->short_description)
        <p class="text-gray-600">{{ $service->short_description }}</p>
    @endif
</div>

<!-- Pricing Info Card -->
@if($service->price || $service->deposit_amount)
<div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Pricing Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @if($service->price)
            <div>
                <span class="text-sm text-gray-600">Full Price:</span>
                <span class="text-xl font-bold text-gray-900 ml-2">${{ number_format($service->price, 2) }}</span>
                <span class="text-sm text-gray-500">per student</span>
            </div>
        @endif
        @if($service->deposit_amount)
            <div>
                <span class="text-sm text-gray-600">Deposit Required:</span>
                <span class="text-xl font-bold text-green-600 ml-2">${{ number_format($service->deposit_amount, 2) }}</span>
                <span class="text-sm text-gray-500">per student</span>
            </div>
        @endif
    </div>
</div>
@endif

<!-- Available Classes -->
@if($schedules->count() > 0)
    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h2 class="text-xl font-bold text-gray-800">Available Class Schedules</h2>
            <p class="text-sm text-gray-600 mt-1">Select a class schedule to book</p>
        </div>
        
        <div class="divide-y divide-gray-200">
            @foreach($schedules as $schedule)
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-4 mb-3">
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Date</div>
                                    <div class="text-lg font-bold text-gray-900">{{ $schedule->class_date->format('F d, Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $schedule->class_date->format('l') }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Time</div>
                                    <div class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</div>
                                    @if($schedule->end_time)
                                        <div class="text-sm text-gray-500">to {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</div>
                                    @endif
                                </div>
                                @if($schedule->duration_hours)
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Duration</div>
                                    <div class="text-lg font-semibold text-gray-900">{{ $schedule->duration_hours }} {{ Str::plural('hour', $schedule->duration_hours) }}</div>
                                </div>
                                @endif
                            </div>
                            
                            <div class="flex items-center gap-6 flex-wrap mt-4">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-users text-gray-400"></i>
                                    <span class="text-sm text-gray-600">
                                        <span class="font-semibold text-gray-900">{{ $schedule->current_students }}</span> / {{ $schedule->max_students }} enrolled
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user-check text-green-500"></i>
                                    <span class="text-sm text-green-600 font-semibold">
                                        {{ $schedule->getAvailableSpots() }} spot(s) available
                                    </span>
                                </div>
                                @if($schedule->min_students)
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-info-circle text-blue-500"></i>
                                    <span class="text-sm text-gray-600">Min: {{ $schedule->min_students }} students</span>
                                </div>
                                @endif
                                @if($schedule->room)
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-door-open text-gray-400"></i>
                                    <span class="text-sm text-gray-600">Room: {{ $schedule->room }}</span>
                                </div>
                                @endif
                                @if($schedule->instructor)
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-chalkboard-teacher text-gray-400"></i>
                                    <span class="text-sm text-gray-600">{{ $schedule->instructor }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex flex-col items-end gap-2">
                            <a href="{{ route('customer.booking.create.schedule', ['serviceId' => $service->id, 'scheduleId' => $schedule->id]) }}" 
                               class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors inline-flex items-center gap-2">
                                <i class="fas fa-calendar-plus"></i> Book This Class
                            </a>
                            @if($schedule->getAvailableSpots() <= 3)
                                <span class="text-xs text-orange-600 font-semibold">
                                    <i class="fas fa-exclamation-triangle"></i> Limited spots remaining
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <i class="fas fa-calendar-times text-5xl text-gray-400 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">No Available Classes</h3>
        <p class="text-gray-600 mb-6">There are no available class schedules at this time. Please check back later or contact us for more information.</p>
        <a href="{{ route('service.details', $service->id) }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
            Back to Service Details
        </a>
    </div>
@endif

@if(session('success'))
    <div class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('error') }}
    </div>
@endif
@endsection

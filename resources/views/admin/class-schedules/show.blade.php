@extends('admin.layouts.master')

@section('title', 'Class Schedule Details')
@section('page-title', 'Class Schedule Details')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.class-schedules.index') }}" class="text-blue-600 hover:underline inline-flex items-center gap-2 mb-4">
        <i class="fas fa-arrow-left"></i> Back to Schedules
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Information -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Schedule Details Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">Schedule Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Service (Class)</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $classSchedule->service->title }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Date</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $classSchedule->class_date->format('l, F d, Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Start Time</label>
                    <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($classSchedule->start_time)->format('h:i A') }}</p>
                </div>
                @if($classSchedule->end_time)
                <div>
                    <label class="block text-sm font-medium text-gray-500">End Time</label>
                    <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($classSchedule->end_time)->format('h:i A') }}</p>
                </div>
                @endif
                <div>
                    <label class="block text-sm font-medium text-gray-500">Duration</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $classSchedule->duration_hours }} {{ Str::plural('hour', $classSchedule->duration_hours) }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Status</label>
                    @if($classSchedule->status === 'scheduled')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Scheduled</span>
                    @elseif($classSchedule->status === 'full')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Full</span>
                    @elseif($classSchedule->status === 'cancelled')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                    @elseif($classSchedule->status === 'completed')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Capacity Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">Capacity Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Current Students</label>
                    <p class="text-3xl font-bold text-gray-900">{{ $classSchedule->current_students }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Max Students</label>
                    <p class="text-3xl font-bold text-gray-900">{{ $classSchedule->max_students }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Min Students</label>
                    <p class="text-3xl font-bold text-gray-900">{{ $classSchedule->min_students }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div class="bg-green-600 h-4 rounded-full" style="width: {{ min(100, ($classSchedule->current_students / $classSchedule->max_students) * 100) }}%"></div>
                </div>
                <p class="text-sm text-gray-600 mt-2">
                    {{ $classSchedule->getAvailableSpots() }} spot(s) available
                </p>
            </div>
        </div>

        <!-- Room and Instructor -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">Location & Instructor</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Room</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $classSchedule->room ?? 'Not assigned' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Instructor</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $classSchedule->instructor ?? 'Not assigned' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Can Overlap</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $classSchedule->can_overlap ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>

        @if($classSchedule->notes)
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">Notes</h3>
            <p class="text-gray-700">{{ $classSchedule->notes }}</p>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Actions Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">Actions</h3>
            <div class="space-y-2">
                <a href="{{ route('admin.class-schedules.edit', $classSchedule) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded">
                    <i class="fas fa-edit mr-2"></i> Edit Schedule
                </a>
                <form method="POST" action="{{ route('admin.class-schedules.destroy', $classSchedule) }}" onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                        <i class="fas fa-trash mr-2"></i> Delete Schedule
                    </button>
                </form>
            </div>
        </div>

        <!-- Bookings Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">Bookings</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $classSchedule->bookings->count() }}</p>
            <p class="text-sm text-gray-500 mt-1">Total bookings for this schedule</p>
            @if($classSchedule->bookings->count() > 0)
                <a href="{{ route('admin.bookings.index', ['schedule' => $classSchedule->id]) }}" class="mt-4 inline-block text-blue-600 hover:underline text-sm">
                    View all bookings →
                </a>
            @endif
        </div>
    </div>
</div>
@endsection

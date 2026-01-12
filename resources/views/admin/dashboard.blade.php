@extends('admin.layouts.master')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Services Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Services</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $servicesCount }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-full">
                <i class="fas fa-briefcase text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Active Services Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Active Services</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $activeServicesCount }}</p>
            </div>
            <div class="bg-blue-100 p-4 rounded-full">
                <i class="fas fa-check-circle text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-semibold mb-4">Quick Actions</h3>
    <div class="flex gap-4">
        <a href="{{ route('admin.services.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
            <i class="fas fa-plus mr-2"></i> Add New Service
        </a>
        <a href="{{ route('admin.services.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded">
            <i class="fas fa-list mr-2"></i> View All Services
        </a>
    </div>
</div>
@endsection

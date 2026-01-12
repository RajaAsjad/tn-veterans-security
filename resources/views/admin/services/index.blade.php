@extends('admin.layouts.master')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', 'Services')
@section('page-title', 'Services Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-semibold">All Services</h3>
    <a href="{{ route('admin.services.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
        <i class="fas fa-plus mr-2"></i> Add New Service
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($services as $service)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="h-16 w-16 object-cover rounded">
                        @else
                            <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $service->title }}</div>
                        @if($service->short_description)
                            <div class="text-sm text-gray-500">{{ Str::limit($service->short_description, 50) }}</div>
                        @elseif($service->description)
                            <div class="text-sm text-gray-500">{{ Str::limit(strip_tags($service->description), 50) }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $service->order }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($service->is_active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.services.edit', $service) }}" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No services found. <a href="{{ route('admin.services.create') }}" class="text-green-600 hover:underline">Create one now</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

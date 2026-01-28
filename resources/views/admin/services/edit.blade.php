@extends('admin.layouts.master')

@section('title', 'Edit Service')
@section('page-title', 'Edit Service')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title *</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   value="{{ old('title', $service->title) }}"
                   required 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="short_description" class="block text-gray-700 text-sm font-bold mb-2">Short Description</label>
            <textarea id="short_description" 
                      name="short_description" 
                      rows="3"
                      maxlength="500"
                      placeholder="Brief description (max 500 characters)"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('short_description', $service->short_description) }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Maximum 500 characters</p>
            @error('short_description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <div id="description-editor" class="bg-white border rounded">
                {!! old('description', $service->description) !!}
            </div>
            <textarea id="description" name="description" style="display:none;">{{ old('description', $service->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
            @if($service->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="h-32 w-32 object-cover rounded">
                </div>
            @endif
            <input type="file" 
                   id="image" 
                   name="image" 
                   accept="image/*"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="order" class="block text-gray-700 text-sm font-bold mb-2">Order</label>
            <input type="number" 
                   id="order" 
                   name="order" 
                   value="{{ old('order', $service->order) }}"
                   min="0"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('order')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pricing Section -->
        <div class="mb-6 border-t pt-4 mt-6">
            <h3 class="text-lg font-bold mb-4">Pricing & Class Configuration</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price ($)</label>
                    <input type="number" 
                           id="price" 
                           name="price" 
                           value="{{ old('price', $service->price) }}"
                           step="0.01"
                           min="0"
                           placeholder="0.00"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="deposit_amount" class="block text-gray-700 text-sm font-bold mb-2">Deposit Amount ($)</label>
                    <input type="number" 
                           id="deposit_amount" 
                           name="deposit_amount" 
                           value="{{ old('deposit_amount', $service->deposit_amount) }}"
                           step="0.01"
                           min="0"
                           placeholder="0.00"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('deposit_amount')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="class_type" class="block text-gray-700 text-sm font-bold mb-2">Class Type</label>
                    <select id="class_type" 
                            name="class_type" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="group" {{ old('class_type', $service->class_type ?? 'group') === 'group' ? 'selected' : '' }}>Group</option>
                        <option value="one-on-one" {{ old('class_type', $service->class_type) === 'one-on-one' ? 'selected' : '' }}>One-on-One</option>
                    </select>
                    @error('class_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="has_online_parts" 
                           value="1"
                           {{ old('has_online_parts', $service->has_online_parts) ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm text-gray-700">Has online parts/components</span>
                </label>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="testing_in_person" 
                           value="1"
                           {{ old('testing_in_person', $service->testing_in_person ?? true) ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm text-gray-700">Testing is in-person (always true)</span>
                </label>
            </div>
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" 
                       name="is_active" 
                       value="1"
                       {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                       class="mr-2">
                <span class="text-sm text-gray-700">Active</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-save mr-2"></i> Update Service
            </button>
            <a href="{{ route('admin.services.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancel
            </a>
        </div>
    </form>
</div>

<!-- Quill Rich Text Editor -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get existing content from textarea
        var existingContent = document.getElementById('description').value;
        
        var quill = new Quill('#description-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: 'Enter service description...'
        });

        // Set existing content if available
        if (existingContent) {
            quill.root.innerHTML = existingContent;
        }

        // Update textarea on content change
        quill.on('text-change', function() {
            var descriptionInput = document.getElementById('description');
            descriptionInput.value = quill.root.innerHTML;
        });

        // Also update textarea before form submit (as backup)
        var form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            var descriptionInput = document.getElementById('description');
            descriptionInput.value = quill.root.innerHTML;
        });
    });
</script>
<style>
    .ql-container {
        min-height: 300px;
    }
</style>
@endsection

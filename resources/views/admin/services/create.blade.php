@extends('admin.layouts.master')

@section('title', 'Create Service')
@section('page-title', 'Create New Service')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title *</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   value="{{ old('title') }}"
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
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('short_description') }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Maximum 500 characters</p>
            @error('short_description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <div id="description-editor" class="bg-white border rounded">
                {!! old('description') !!}
            </div>
            <textarea id="description" name="description" style="display:none;">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
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
                   value="{{ old('order', 0) }}"
                   min="0"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('order')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category Section -->
        <div class="mb-6 border-t pt-4 mt-6">
            <h3 class="text-lg font-bold mb-4">Category & Organization</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                    <select id="category" 
                            name="category" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Category</option>
                        <option value="security_training" {{ old('category') === 'security_training' ? 'selected' : '' }}>Security Training</option>
                        <option value="nra" {{ old('category') === 'nra' ? 'selected' : '' }}>NRA</option>
                        <option value="red_cross" {{ old('category') === 'red_cross' ? 'selected' : '' }}>Red Cross</option>
                        <option value="handgun_carry" {{ old('category') === 'handgun_carry' ? 'selected' : '' }}>Handgun Carry Permit</option>
                        <option value="services" {{ old('category') === 'services' ? 'selected' : '' }}>Services</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="subcategory" class="block text-gray-700 text-sm font-bold mb-2">Subcategory</label>
                    <input type="text" 
                           id="subcategory" 
                           name="subcategory" 
                           value="{{ old('subcategory') }}"
                           placeholder="e.g., Armed Security, ASP, Force Science"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('subcategory')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Location</label>
                    <select id="location" 
                            name="location" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">No Specific Location</option>
                        <option value="Location A" {{ old('location') === 'Location A' ? 'selected' : '' }}>Location A</option>
                        <option value="Location B" {{ old('location') === 'Location B' ? 'selected' : '' }}>Location B</option>
                    </select>
                    @error('location')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="requires_dallas_law" 
                               value="1"
                               {{ old('requires_dallas_law') ? 'checked' : '' }}
                               class="mr-2">
                        <span class="text-sm text-gray-700">Requires Dallas Law Training</span>
                    </label>
                </div>

                <div>
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="requires_active_shooter" 
                               value="1"
                               {{ old('requires_active_shooter') ? 'checked' : '' }}
                               class="mr-2">
                        <span class="text-sm text-gray-700">Requires Active Shooter Training</span>
                    </label>
                </div>
            </div>
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
                           value="{{ old('price') }}"
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
                           value="{{ old('deposit_amount') }}"
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
                        <option value="group" {{ old('class_type', 'group') === 'group' ? 'selected' : '' }}>Group</option>
                        <option value="one-on-one" {{ old('class_type') === 'one-on-one' ? 'selected' : '' }}>One-on-One</option>
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
                           {{ old('has_online_parts') ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm text-gray-700">Has online parts/components</span>
                </label>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="testing_in_person" 
                           value="1"
                           {{ old('testing_in_person', true) ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm text-gray-700">Testing is in-person (always true)</span>
                </label>
            </div>
        </div>

        <!-- Linked Services (Related Trainings) -->
        <div class="mb-6 border-t pt-4 mt-6">
            <h3 class="text-lg font-bold mb-2">Linked Services (Related Trainings)</h3>
            <p class="text-sm text-gray-600 mb-3">Select trainings to show as related on this service’s page (e.g. Unarmed → Less Lethal, Dallas Law). Order is determined by the list below.</p>
            <div class="max-h-48 overflow-y-auto border rounded p-3 bg-gray-50 space-y-2">
                @forelse(($allServices ?? collect()) as $s)
                    <label class="flex items-center gap-2 cursor-pointer hover:bg-gray-100 p-2 rounded">
                        <input type="checkbox"
                               name="linked_services[]"
                               value="{{ $s->id }}"
                               {{ in_array($s->id, old('linked_services', [])) ? 'checked' : '' }}
                               class="rounded">
                        <span class="text-sm text-gray-800">{{ $s->title }}</span>
                        @if($s->subcategory)
                            <span class="text-xs text-gray-500">({{ $s->subcategory }})</span>
                        @endif
                    </label>
                @empty
                    <p class="text-sm text-gray-500">No other active services. Create more services to link.</p>
                @endforelse
            </div>
            @error('linked_services.*')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" 
                       name="is_active" 
                       value="1"
                       {{ old('is_active', true) ? 'checked' : '' }}
                       class="mr-2">
                <span class="text-sm text-gray-700">Active</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-save mr-2"></i> Create Service
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

@extends('admin.layouts.master')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf

        <!-- Logo Section -->
        <div class="mb-8">
            <h3 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Logos & Favicon</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Header Logo -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Header Logo</label>
                    @if(isset($settings) && $settings && $settings->header_logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settings->header_logo) }}" alt="Header Logo" class="h-20 w-auto object-contain border rounded p-2">
                        </div>
                    @endif
                    <input type="file" name="header_logo" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('header_logo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Footer Logo -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Footer Logo</label>
                    @if(isset($settings) && $settings && $settings->footer_logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settings->footer_logo) }}" alt="Footer Logo" class="h-20 w-auto object-contain border rounded p-2">
                        </div>
                    @endif
                    <input type="file" name="footer_logo" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('footer_logo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Favicon -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Favicon</label>
                    @if(isset($settings) && $settings && $settings->favicon)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settings->favicon) }}" alt="Favicon" class="h-16 w-16 object-contain border rounded p-2">
                        </div>
                    @endif
                    <input type="file" name="favicon" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <p class="text-xs text-gray-500 mt-1">Recommended: 32x32 or 16x16 pixels</p>
                    @error('favicon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="mb-8">
            <h3 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Contact Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone', $settings->phone ?? '') }}"
                           placeholder="e.g., 615-554-1131"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $settings->email ?? '') }}"
                           placeholder="e.g., info@example.com"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Address -->
            <div class="mt-6">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                <textarea id="address" 
                          name="address" 
                          rows="3"
                          placeholder="e.g., 123 Security Way, Nashville, TN 37201"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('address', $settings->address ?? '') }}</textarea>
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Social Media Links Section -->
        <div class="mb-8">
            <h3 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Social Media Links</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Facebook -->
                <div>
                    <label for="facebook_url" class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fab fa-facebook text-blue-600 mr-2"></i> Facebook URL
                    </label>
                    <input type="url" 
                           id="facebook_url" 
                           name="facebook_url" 
                           value="{{ old('facebook_url', $settings->facebook_url ?? '') }}"
                           placeholder="https://facebook.com/yourpage"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('facebook_url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Twitter -->
                <div>
                    <label for="twitter_url" class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fab fa-twitter text-blue-400 mr-2"></i> Twitter URL
                    </label>
                    <input type="url" 
                           id="twitter_url" 
                           name="twitter_url" 
                           value="{{ old('twitter_url', $settings->twitter_url ?? '') }}"
                           placeholder="https://twitter.com/yourhandle"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('twitter_url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instagram -->
                <div>
                    <label for="instagram_url" class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fab fa-instagram text-pink-600 mr-2"></i> Instagram URL
                    </label>
                    <input type="url" 
                           id="instagram_url" 
                           name="instagram_url" 
                           value="{{ old('instagram_url', $settings->instagram_url ?? '') }}"
                           placeholder="https://instagram.com/yourhandle"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('instagram_url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- LinkedIn -->
                <div>
                    <label for="linkedin_url" class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fab fa-linkedin text-blue-700 mr-2"></i> LinkedIn URL
                    </label>
                    <input type="url" 
                           id="linkedin_url" 
                           name="linkedin_url" 
                           value="{{ old('linkedin_url', $settings->linkedin_url ?? '') }}"
                           placeholder="https://linkedin.com/company/yourcompany"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('linkedin_url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- YouTube -->
                <div>
                    <label for="youtube_url" class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fab fa-youtube text-red-600 mr-2"></i> YouTube URL
                    </label>
                    <input type="url" 
                           id="youtube_url" 
                           name="youtube_url" 
                           value="{{ old('youtube_url', $settings->youtube_url ?? '') }}"
                           placeholder="https://youtube.com/yourchannel"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('youtube_url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@extends('customer.layouts.master')

@section('title', 'My Profile')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">My Profile</h1>
    <p class="text-gray-600 mt-2">Update your profile information</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <form method="POST" action="{{ route('customer.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Profile Information</h2>
        </div>

        <div class="p-6 space-y-6">
            <!-- Profile Picture -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Profile Picture</label>
                <div class="flex items-center gap-6">
                    <div class="flex-shrink-0">
                        @if($customer->profile_picture)
                            <img src="{{ asset('storage/' . $customer->profile_picture) }}" 
                                 alt="Profile" 
                                 id="profile-preview"
                                 class="h-32 w-32 rounded-full object-cover border-4 border-gray-200 shadow-md">
                        @else
                            <div id="profile-preview-placeholder" class="h-32 w-32 rounded-full bg-gray-300 flex items-center justify-center border-4 border-gray-200 shadow-md">
                                <i class="fas fa-user text-5xl text-gray-500"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label for="profile_picture" class="block mb-2">
                            <span class="block text-sm font-medium text-gray-700 mb-2">Upload New Picture</span>
                            <div class="relative">
                                <input type="file" 
                                       name="profile_picture" 
                                       id="profile_picture"
                                       accept="image/*"
                                       class="block w-full text-sm text-gray-500
                                              file:mr-4 file:py-2.5 file:px-6
                                              file:rounded-lg file:border-0
                                              file:text-sm file:font-semibold
                                              file:text-white file:cursor-pointer
                                              hover:file:opacity-90
                                              cursor-pointer
                                              border border-gray-300 rounded-lg
                                              focus:outline-none focus:ring-2 focus:ring-[#3AA62C] focus:border-transparent">
                            </div>
                        </label>
                        <p class="text-xs text-gray-500 mt-2">JPG, PNG or GIF. Max size 2MB</p>
                        @error('profile_picture')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <style>
                input[type="file"]#profile_picture::file-selector-button {
                    background-color: #3AA62C;
                    color: white;
                    border: 0;
                    padding: 0.625rem 1.5rem;
                    border-radius: 0.5rem;
                    font-weight: 600;
                    font-size: 0.875rem;
                    cursor: pointer;
                    transition: background-color 0.2s;
                }
                
                input[type="file"]#profile_picture::file-selector-button:hover {
                    background-color: #175B0E;
                }
            </style>
            
            <script>
                document.getElementById('profile_picture').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.getElementById('profile-preview');
                            const placeholder = document.getElementById('profile-preview-placeholder');
                            
                            if (preview) {
                                preview.src = e.target.result;
                            } else if (placeholder) {
                                placeholder.innerHTML = '<img src="' + e.target.result + '" class="h-32 w-32 rounded-full object-cover border-4 border-gray-200 shadow-md" alt="Profile" id="profile-preview">';
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            </script>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $customer->name) }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $customer->email) }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input type="text" 
                       id="phone" 
                       name="phone" 
                       value="{{ old('phone', $customer->phone) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <textarea id="address" 
                          name="address" 
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent">{{ old('address', $customer->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Section -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Change Password</h3>
                <p class="text-sm text-gray-600 mb-4">Leave blank if you don't want to change your password</p>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <input type="password" 
                           id="password" 
                           name="password"
                           minlength="8"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation"
                           minlength="8"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('customer.dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 text-white font-semibold rounded-lg transition-colors shadow-md" style="background-color: #3AA62C;" onmouseover="this.style.backgroundColor='#175B0E'" onmouseout="this.style.backgroundColor='#3AA62C'">
                    Update Profile
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

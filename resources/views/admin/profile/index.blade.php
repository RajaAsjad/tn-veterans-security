@extends('admin.layouts.master')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <!-- Profile Picture Section -->
        <div class="mb-8">
            <h3 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Profile Picture</h3>
            
            <div class="flex items-center gap-6">
                <div class="flex-shrink-0">
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                             alt="Profile Picture" 
                             class="h-32 w-32 rounded-full object-cover border-4 border-gray-200">
                    @else
                        <div class="h-32 w-32 rounded-full bg-gray-300 flex items-center justify-center border-4 border-gray-200">
                            <i class="fas fa-user text-gray-500 text-5xl"></i>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <label for="profile_picture" class="block text-gray-700 text-sm font-bold mb-2">Upload New Picture</label>
                    <input type="file" 
                           id="profile_picture" 
                           name="profile_picture" 
                           accept="image/*"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <p class="text-xs text-gray-500 mt-1">Recommended: Square image, max 2MB (JPG, PNG, GIF)</p>
                    @error('profile_picture')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="mb-8">
            <h3 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Personal Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}"
                           required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address *</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}"
                           required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Change Password Section -->
        <div class="mb-8">
            <h3 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Change Password</h3>
            <p class="text-sm text-gray-600 mb-4">Leave blank if you don't want to change your password.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">Current Password</label>
                    <input type="password" 
                           id="current_password" 
                           name="current_password" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
        </div>

        <!-- Account Information -->
        <div class="mb-8 bg-gray-50 p-4 rounded-lg">
            <h3 class="text-lg font-bold mb-3 text-gray-800">Account Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Member Since:</span>
                    <span class="font-semibold text-gray-800 ml-2">{{ $user->created_at->format('F Y') }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Last Updated:</span>
                    <span class="font-semibold text-gray-800 ml-2">{{ $user->updated_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                <i class="fas fa-save mr-2"></i> Update Profile
            </button>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                Cancel
            </a>
        </div>
    </form>
</div>

<!-- Preview Profile Picture on Upload -->
<script>
    document.getElementById('profile_picture').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.querySelector('img[alt="Profile Picture"]');
                if (img) {
                    img.src = e.target.result;
                } else {
                    const div = document.querySelector('.h-32.w-32.rounded-full.bg-gray-300');
                    if (div) {
                        div.innerHTML = `<img src="${e.target.result}" class="h-32 w-32 rounded-full object-cover border-4 border-gray-200" alt="Profile Picture">`;
                    }
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

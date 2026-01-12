<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login - TN Veterans Security</title>
    
    <!-- Favicon -->
    @php
        $siteSettings = \App\Models\SiteSetting::first();
    @endphp
    @if($siteSettings && $siteSettings->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $siteSettings->favicon) }}?v={{ $siteSettings->updated_at->timestamp ?? time() }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Customer Login</h1>
            <p class="text-gray-600 mt-2">TN Veterans Security</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('customer.login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       required 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-sm text-gray-700">Remember me</span>
                </label>
            </div>

            <button type="submit" 
                    class="w-full text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-colors shadow-md" style="background-color: #3AA62C;" onmouseover="this.style.backgroundColor='#175B0E'" onmouseout="this.style.backgroundColor='#3AA62C'">
                Login
            </button>
        </form>

        <div class="mt-6 text-center space-y-2">
            <p class="text-sm text-gray-600">
                Don't have an account? 
                <a href="{{ route('customer.register') }}" class="hover:underline font-semibold transition-colors" style="color: #3AA62C;" onmouseover="this.style.color='#175B0E'" onmouseout="this.style.color='#3AA62C'">Sign Up</a>
            </p>
            <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:text-gray-800">Back to Website</a>
        </div>
    </div>
</body>
</html>

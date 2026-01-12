<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Customer Dashboard') - TN Veterans Security</title>
    
    <!-- Favicon -->
    @if($siteSettings && $siteSettings->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $siteSettings->favicon) }}?v={{ $siteSettings->updated_at->timestamp ?? time() }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Top Navigation -->
        <nav class="bg-white shadow-md">
            <div class="container mx-auto px-4 lg:px-10">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-xl font-bold" style="color: #3AA62C;">
                            TN Veterans Security
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ url('/') }}" class="text-gray-600 transition-colors" onmouseover="this.style.color='#3AA62C'" onmouseout="this.style.color='#6b7280'">Back to Website</a>
                        @auth('customer')
                            <span class="text-gray-600">Welcome, {{ Auth::guard('customer')->user()->name }}</span>
                            <form method="POST" action="{{ route('customer.logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-red-600">Logout</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="w-64 bg-gray-800 text-white hidden lg:block">
                <nav class="p-6 space-y-2">
                    <a href="{{ route('customer.dashboard') }}" class="block px-4 py-3 rounded hover:bg-gray-700 {{ request()->routeIs('customer.dashboard') ? 'bg-gray-700' : '' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                    <a href="{{ route('customer.bookings') }}" class="block px-4 py-3 rounded hover:bg-gray-700 {{ request()->routeIs('customer.bookings*') ? 'bg-gray-700' : '' }}">
                        <i class="fas fa-calendar-check mr-3"></i> My Bookings
                    </a>
                    <a href="{{ route('customer.profile') }}" class="block px-4 py-3 rounded hover:bg-gray-700 {{ request()->routeIs('customer.profile*') ? 'bg-gray-700' : '' }}">
                        <i class="fas fa-user mr-3"></i> My Profile
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

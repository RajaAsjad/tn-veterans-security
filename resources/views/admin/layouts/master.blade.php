<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - TN Veterans Security</title>
    
    <!-- Favicon -->
    @if($siteSettings && $siteSettings->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $siteSettings->favicon) }}?v={{ $siteSettings->updated_at->timestamp ?? time() }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/' . $siteSettings->favicon) }}?v={{ $siteSettings->updated_at->timestamp ?? time() }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
                <p class="text-gray-400 text-sm mt-1">TN Veterans Security</p>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 border-l-4 border-green-500' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <a href="{{ route('admin.services.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.services.*') ? 'bg-gray-700 border-l-4 border-green-500' : '' }}">
                    <i class="fas fa-briefcase mr-3"></i> Services
                </a>
                <a href="{{ route('admin.settings.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-700 border-l-4 border-green-500' : '' }}">
                    <i class="fas fa-cog mr-3"></i> Site Settings
                </a>
                <a href="{{ route('admin.profile.show') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.profile.*') ? 'bg-gray-700 border-l-4 border-green-500' : '' }}">
                    <i class="fas fa-user mr-3"></i> My Profile
                </a>
                <a href="{{ url('/') }}" class="block px-6 py-3 hover:bg-gray-700" target="_blank">
                    <i class="fas fa-external-link-alt mr-3"></i> View Website
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full text-left px-6 py-3 hover:bg-gray-700">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4 flex justify-between items-center">
                    <h2 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.profile.show') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                                     alt="Profile" 
                                     class="h-10 w-10 rounded-full object-cover border-2 border-gray-300">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-400 flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            @endif
                            <span class="text-gray-600">{{ Auth::user()->name ?? 'Admin' }}</span>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-6">
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
            </div>
        </main>
    </div>
</body>
</html>

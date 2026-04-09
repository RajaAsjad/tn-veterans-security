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
    @stack('head')
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen flex-col">
        <!-- Top Navigation -->
        <nav class="z-40 bg-white shadow-md max-lg:sticky max-lg:top-0">
            <div class="mx-auto max-w-7xl px-4 lg:px-10">
                <div class="flex h-14 min-h-[3.5rem] items-center justify-between gap-2 sm:h-16">
                    <div class="flex min-w-0 flex-1 items-center gap-2 sm:gap-3">
                        <button
                            type="button"
                            id="customer-sidebar-open"
                            class="shrink-0 rounded p-2 text-gray-600 hover:bg-gray-100 lg:hidden"
                            aria-label="Open menu"
                            aria-expanded="false"
                            aria-controls="customer-sidebar"
                        >
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                        <a href="{{ url('/') }}" class="truncate text-lg font-bold text-[#3AA62C] sm:text-xl">
                            TN Veterans Security
                        </a>
                    </div>
                    <div class="flex shrink-0 items-center gap-2 sm:gap-4">
                        <a href="{{ url('/') }}" class="hidden text-sm text-gray-600 hover:text-[#3AA62C] sm:inline">
                            Back to Website
                        </a>
                        @auth('customer')
                            <span class="hidden max-w-[9rem] truncate text-sm text-gray-600 md:inline md:max-w-xs">
                                Welcome, {{ Auth::guard('customer')->user()->name }}
                            </span>
                            <form method="POST" action="{{ route('customer.logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm text-gray-600 hover:text-red-600">Logout</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <div class="relative flex min-h-0 flex-1">
            <!-- Below header on mobile; full column height on lg+ -->
            <div
                id="customer-sidebar-backdrop"
                class="fixed left-0 right-0 top-14 z-50 bg-black/50 sm:top-16 lg:hidden hidden"
                aria-hidden="true"
            ></div>

            <!-- Sidebar: drawer below sticky nav; above nav when open -->
            <div
                id="customer-sidebar"
                class="fixed bottom-0 left-0 top-14 z-[60] w-64 max-w-[min(100vw,16rem)] shrink-0 -translate-x-full bg-gray-800 text-white transition-transform duration-200 ease-out sm:top-16 lg:static lg:top-auto lg:z-auto lg:max-w-none lg:translate-x-0"
            >
                <aside class="flex h-full min-h-0 flex-col overflow-y-auto lg:sticky lg:top-0 lg:h-screen lg:max-h-screen">
                    <div class="flex items-start justify-between gap-2 border-b border-gray-700/80 p-4 lg:hidden">
                        <span class="text-sm font-semibold text-gray-300">Menu</span>
                        <button
                            type="button"
                            id="customer-sidebar-close"
                            class="rounded p-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                            aria-label="Close menu"
                        >
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    <nav class="space-y-2 p-4 sm:p-6">
                        <a href="{{ route('customer.dashboard') }}" class="block rounded px-4 py-3 hover:bg-gray-700 {{ request()->routeIs('customer.dashboard') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                        <a href="{{ route('customer.bookings') }}" class="block rounded px-4 py-3 hover:bg-gray-700 {{ request()->routeIs('customer.bookings*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-calendar-check mr-3"></i> My Bookings
                        </a>
                        <a href="{{ route('customer.profile') }}" class="block rounded px-4 py-3 hover:bg-gray-700 {{ request()->routeIs('customer.profile*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-user mr-3"></i> My Profile
                        </a>
                        <a href="{{ url('/') }}" class="block rounded px-4 py-3 hover:bg-gray-700 lg:hidden">
                            <i class="fas fa-home mr-3"></i> Back to Website
                        </a>
                    </nav>
                </aside>
            </div>

            <main class="min-w-0 flex-1">
                <div class="overflow-x-hidden p-4 sm:p-6">
                {{--  @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('warning'))
                    <div class="bg-amber-100 border border-amber-400 text-amber-800 px-4 py-3 rounded mb-4">
                        {{ session('warning') }}
                    </div>
                @endif --}}

                @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        (function () {
            const sidebar = document.getElementById('customer-sidebar');
            const backdrop = document.getElementById('customer-sidebar-backdrop');
            const openBtn = document.getElementById('customer-sidebar-open');
            const closeBtn = document.getElementById('customer-sidebar-close');

            if (!sidebar || !backdrop) {
                return;
            }

            function isDrawerBreakpoint() {
                return window.matchMedia('(max-width: 1023px)').matches;
            }

            function openDrawer() {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                openBtn?.setAttribute('aria-expanded', 'true');
            }

            function closeDrawer() {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                openBtn?.setAttribute('aria-expanded', 'false');
            }

            openBtn?.addEventListener('click', function () {
                openDrawer();
            });

            closeBtn?.addEventListener('click', function () {
                closeDrawer();
            });

            backdrop.addEventListener('click', function () {
                closeDrawer();
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && isDrawerBreakpoint()) {
                    closeDrawer();
                }
            });

            sidebar.querySelectorAll('nav a[href]').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (isDrawerBreakpoint()) {
                        closeDrawer();
                    }
                });
            });

            window.addEventListener('resize', function () {
                if (!isDrawerBreakpoint()) {
                    closeDrawer();
                }
            });
        })();
    </script>
</body>
</html>

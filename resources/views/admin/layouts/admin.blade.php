@include('mainlayouts.header')

<div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Mobile Header -->
        <div class="lg:hidden bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800">Admin Panel</h1>
            <button type="button" class="mobile-menu-button p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Sidebar Overlay (Mobile) -->
        <div class="mobile-menu-overlay fixed inset-0 bg-gray-600 bg-opacity-75 hidden lg:hidden z-20"></div>

        <!-- Sidebar -->
        <aside class="sidebar fixed inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 lg:static lg:w-72 bg-gradient-to-b from-gray-900 to-gray-800 text-white transition-transform duration-300 ease-in-out z-30 shadow-xl">
            <div class="h-full flex flex-col">
                <!-- Logo Area -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="h-8 w-8 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M5 17v4M3 19h4M17 3v4M15 5h4M17 17v4M15 19h4M9 9h6v6H9z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold">CarRental<span class="text-blue-400">Admin</span></span>
                    </div>
                    <!-- Close button for mobile -->
                    <button class="mobile-menu-close lg:hidden text-gray-400 hover:text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto py-6 px-4">
                    <div class="space-y-1">
                        <!-- Dashboard Link -->
                        <a href="{{ route('admin.layouts.dashboard') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.layouts.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.layouts.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                            @if(request()->routeIs('admin.layouts.dashboard'))
                                <span class="ml-auto bg-white bg-opacity-20 rounded-full px-2 py-0.5 text-xs">Current</span>
                            @endif
                        </a>

                        <!-- Bookings Link -->
                        <a href="{{ route('admin.bookings.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.bookings.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Bookings
                            @if(request()->routeIs('admin.bookings.*'))
                                <span class="ml-auto bg-white bg-opacity-20 rounded-full px-2 py-0.5 text-xs">Current</span>
                            @endif
                        </a>

                        <!-- Cars Link (Commented) -->
                        <a href="{{ route('admin.cars.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.cars.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.bookings.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                            Cars
                            @if(request()->routeIs('admin.cars.*'))
                                <span class="ml-auto bg-white bg-opacity-20 rounded-full px-2 py-0.5 text-xs">Current</span>
                            @endif
                        </a>

                        <!-- Users Link (Commented) -->
                        {{-- <a href="{{ route('admin.users') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-800 hover:text-white transition-all duration-200">
                            <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Users
                        </a> --}}
                    </div>

                    <!-- Bottom Section -->
                    <div class="mt-auto pt-10">
                        <div class="border-t border-gray-700 pt-6">
                            <!-- Admin Info -->
                            <div class="flex items-center space-x-3 px-4 py-3 bg-gray-800 rounded-xl">
                                <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                                    <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email ?? 'admin@example.com' }}</p>
                                </div>
                            </div>

                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center px-4 py-3 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-xl transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-red-500">
                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-50 min-h-screen">
            <!-- Top Navigation (Desktop) -->
            

            <!-- Page Content -->
            <div class="p-4 lg:p-8">
                

                <!-- Main Content Area -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <!-- Mobile Menu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.querySelector('.mobile-menu-button');
            const closeButton = document.querySelector('.mobile-menu-close');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.mobile-menu-overlay');

            function openMenu() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeMenu() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            if (menuButton) {
                menuButton.addEventListener('click', openMenu);
            }

            if (closeButton) {
                closeButton.addEventListener('click', closeMenu);
            }

            if (overlay) {
                overlay.addEventListener('click', closeMenu);
            }

            // Close on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
                    closeMenu();
                }
            });
        });
    </script>

    <style>
        /* Custom scrollbar for sidebar */
        .sidebar .overflow-y-auto::-webkit-scrollbar {
            width: 4px;
        }
        
        .sidebar .overflow-y-auto::-webkit-scrollbar-track {
            background: #2d3748;
        }
        
        .sidebar .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #4a5568;
            border-radius: 4px;
        }
        
        .sidebar .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #718096;
        }
    </style>
@yield('scripts')
</body>
</html>

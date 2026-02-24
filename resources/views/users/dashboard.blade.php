@extends('layouts.app')

@section('content')

<div class="min-h-screen py-24 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">
      <!-- Main Content Tabs -->
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Tab Navigation - Responsive -->
            <div class="border-b border-gray-200 px-4 sm:px-6 overflow-x-auto">
                <div class="flex space-x-4 sm:space-x-8 min-w-max sm:min-w-0">
                    <button 
                        onclick="switchTab('profile')" 
                        id="tab-profile-btn"
                        class="tab-btn py-3 sm:py-4 px-1 border-b-2 font-medium text-xs sm:text-sm transition-colors duration-200 flex items-center space-x-1 sm:space-x-2 border-slate-500 text-slate-600 hover:text-gray-700 hover:border-gray-300"
                    >
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Profile</span>
                    </button>

                    <button 
                        onclick="switchTab('bookings')" 
                        id="tab-bookings-btn"
                        class="tab-btn py-3 sm:py-4 px-1 border-b-2 font-medium text-xs sm:text-sm transition-colors duration-200 flex items-center space-x-1 sm:space-x-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                    >
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>Booking Requests</span>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-1.5 sm:px-2 py-0.5 rounded-full">{{$pendingCount}}</span>
                    </button>

                    <button 
                        onclick="switchTab('reviews')" 
                        id="tab-reviews-btn"
                        class="tab-btn py-3 sm:py-4 px-1 border-b-2 font-medium text-xs sm:text-sm transition-colors duration-200 flex items-center space-x-1 sm:space-x-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                    >
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        <span>Reviews</span>
                    </button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="p-4 sm:p-6">
                <!-- Profile Tab -->
                <div id="tab-profile" class="tab-content">
                    @include('users.profile')
                </div>

                <!-- Bookings Tab -->
                <div id="tab-bookings" class="tab-content hidden">
                    @include('users.booking-request')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vanilla JavaScript for Tabs -->
<script>
    function switchTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Show selected tab content
        document.getElementById(`tab-${tabName}`).classList.remove('hidden');
        
        // Update button styles
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('border-slate-500', 'text-slate-600');
            btn.classList.add('border-transparent', 'text-gray-500');
        });
        
        // Style active button
        const activeBtn = document.getElementById(`tab-${tabName}-btn`);
        activeBtn.classList.remove('border-transparent', 'text-gray-500');
        activeBtn.classList.add('border-slate-500', 'text-slate-600');
    }

    // Handle responsive mobile menu if needed
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>
@endsection

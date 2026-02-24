<div class="max-w-5xl mx-auto">
    <!-- Profile Header - Responsive -->
    <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-6 mb-6 sm:mb-8">
        <div class="relative">
            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl sm:rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-2xl sm:text-3xl font-bold">
                {{ substr(auth()->user()->name, 0, 2) }}
            </div>
            <button class="absolute -bottom-2 -right-2 bg-white rounded-full p-1.5 sm:p-2 shadow-md hover:shadow-lg transition-shadow duration-200">
                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </button>
        </div>
        <div class="text-center sm:text-left">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h2>
            <p class="text-sm sm:text-base text-gray-500">Member since {{ auth()->user()->created_at->format('F Y') }}</p>
            <div class="flex flex-wrap justify-center sm:justify-start items-center gap-2 mt-2">
                <span class="px-2 sm:px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Verified</span>
            </div>
        </div>
    </div>

    <!-- Profile Form -->
    <form class="space-y-4 sm:space-y-6" onsubmit="event.preventDefault(); saveProfile();">
        <!-- Name Fields - Responsive Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Name</label>
                <input type="text" id="first_name" value="{{ auth()->user()->name }}" class=" w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg sm:rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200" disabled>
            </div>
            
        </div>

        <!-- Email & Phone -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Email Address</label>
                <input type="email" id="email" value="{{ auth()->user()->email }}" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base rounded-lg sm:rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200" disabled>
            </div>
        </div>

    </form>
</div>
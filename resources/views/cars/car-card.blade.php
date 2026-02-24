<article class="group">
    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden h-full flex flex-col">
        
        <!-- Image Container with Primary Image -->
        <div class="relative h-48 sm:h-56 md:h-64 overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200">
            @php
                $primaryImage = $car->images->firstWhere('is_primary', true) ?? $car->images->first();
            @endphp
            
            @if($primaryImage)
                <img src="{{ Storage::url($primaryImage->image_path) }}" 
                     alt="{{ $car->brand }} {{ $car->model }}"
                     class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <i class="fas fa-car text-5xl sm:text-6xl text-slate-400"></i>
                </div>
            @endif

            <!-- Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

            <!-- Availability Badge -->
            @if ($car->is_available)
                <span class="absolute top-3 left-3 sm:top-4 sm:left-4 bg-green-500 text-white px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs font-semibold shadow-lg z-10">
                    <i class="fas fa-circle text-[8px] mr-1 animate-pulse"></i>
                    Available
                </span>
            @else
                <span class="absolute top-3 left-3 sm:top-4 sm:left-4 bg-red-500 text-white px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs font-semibold shadow-lg z-10">
                    <i class="fas fa-circle text-[8px] mr-1"></i>
                    Unavailable
                </span>
            @endif

            {{-- <!-- Featured Badge -->
            @if ($car->is_featured)
                <span class="absolute top-3 right-3 sm:top-4 sm:right-4 bg-yellow-400 text-yellow-900 px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs font-semibold shadow-lg z-10 flex items-center gap-1">
                    <i class="fas fa-star text-[10px]"></i>
                    Featured
                </span>
            @endif --}}

            

            <!-- Image Counter -->
            @if($car->images->count() > 1)
                <span class="absolute bottom-3 right-3 sm:bottom-4 sm:right-4 bg-black/60 text-white px-2 py-1 rounded-full text-xs font-semibold backdrop-blur-sm flex items-center gap-1">
                    <i class="fas fa-images text-[10px]"></i>
                    {{ $car->images->count() }}
                </span>
            @endif
        </div>

        <!-- Content Container -->
        <div class="p-4 sm:p-5 md:p-6 flex-1 flex flex-col">
            
            <!-- Title and Price Row -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2 mb-3">
                <div>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-gray-900 uppercase leading-tight">
                        {{ $car->brand }}
                    </h3>
                    <p class="text-gray-600 text-xs sm:text-sm flex items-center gap-1">
                        
                        {{ $car->model }} • {{ $car->year }}
                    </p>
                </div>
                {{-- <div class="text-left sm:text-right">
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl sm:text-3xl font-extrabold text-slate-700">
                            ${{ number_format($car->price_per_day, 0) }}
                        </span>
                        <span class="text-gray-500 text-xs sm:text-sm">/day</span>
                    </div>
                </div> --}}
            </div>

            <!-- Features Grid - Responsive -->
            <div class="grid grid-cols-2 gap-2 sm:gap-3 mb-4 flex-1">
                <!-- Transmission -->
                <div class="flex items-center gap-1.5 sm:gap-2 text-gray-600 bg-gray-50 p-2 rounded-lg">
                    <i class="fas fa-gear text-slate-600 text-xs sm:text-sm"></i>
                    <span class="text-xs sm:text-sm font-medium truncate">{{ $car->transmission }}</span>
                </div>

                <!-- Seats -->
                <div class="flex items-center gap-1.5 sm:gap-2 text-gray-600 bg-gray-50 p-2 rounded-lg">
                    <i class="fas fa-users text-slate-600 text-xs sm:text-sm"></i>
                    <span class="text-xs sm:text-sm font-medium">{{ $car->seats }} Seats</span>
                </div>

                <!-- Fuel Type -->
                <div class="flex items-center gap-1.5 sm:gap-2 text-gray-600 bg-gray-50 p-2 rounded-lg">
                    
                    <i class="fas fa-gas-pump text-slate-600 text-xs sm:text-sm"></i>
                    <span class="text-xs sm:text-sm font-medium truncate">{{ $car->fuel_type }}</span>
                </div>

                <!-- RFID / Feature -->
                <div class="flex items-center gap-1.5 sm:gap-2 text-gray-600 bg-gray-50 p-2 rounded-lg">
                    <i class="fa-solid fa-wifi text-slate-600 text-xs sm:text-sm"></i>
                    <span class="text-xs sm:text-sm font-medium truncate">{{ $car->rfid_type ?? 'Standard' }}</span>
                </div>
            </div>

            <!-- Additional Features Row (Optional) -->
            @if($car->description)
                <div class="mb-4">
                    <p class="text-xs sm:text-sm text-gray-500 line-clamp-2">
                        {{ Str::limit($car->description, 60) }}
                    </p>
                </div>
            @endif

            <!-- Book Now Button -->
            <a href="{{ route('car.show', $car->id) }}" class="block mt-auto">
                <button class="w-full bg-gradient-to-r from-slate-700 to-slate-900 hover:from-slate-800 hover:to-slate-950 text-white font-bold py-2.5 sm:py-3 px-4 rounded-xl transition-all duration-300 uppercase text-xs sm:text-sm tracking-wider shadow-md hover:shadow-xl flex items-center justify-center gap-2 group/btn">
                    <span>Book {{ $car->model }}</span>
                    <i class="fas fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
                </button>
            </a>
        </div>
    </div>
</article>
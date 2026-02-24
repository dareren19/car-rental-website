@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded">
            {{ session('error') }}
        </div>
    @endif
    <!-- Simple Car Detail Page -->
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4 lg:px-8 max-w-6xl">

            <!-- Back Button -->
            <a href="{{ route('car.index') }}"
                class="inline-flex items-center text-gray-600 hover:text-slate-700 mb-6 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to listings
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- LEFT: Car Image & Details -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Car Card -->
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                        <!-- Car Image -->
                        <div class="relative w-full max-w-4xl mx-auto" id="carousel">
                            <!-- Carousel Container -->
                            <div class="relative h-96 overflow-hidden rounded-lg">
                                <!-- Check if car has images -->
                                @if ($car->images->isEmpty())
                                    <!-- Default image if no images -->
                                    <div class="absolute inset-0">
                                        <img src="https://via.placeholder.com/1200x600/3b82f6/ffffff?text=No+Image+Available"
                                            class="w-full h-full object-cover">
                                        <div
                                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent text-white p-6">
                                            <h3 class="text-xl font-bold">{{ $car->name }}</h3>
                                            <p>{{ $car->brand }} {{ $car->model }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="relative w-full h-96 md:h-[500px] lg:h-[600px] overflow-hidden rounded-xl group">
                                        <!-- Carousel Slides -->
                                        @foreach ($car->images as $index => $image)
                                            <div class="carousel-slide absolute inset-0 transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
                                                data-slide="{{ $index }}">
                                                <img src="{{ Storage::url($image->image_path) }}"
                                                    alt="{{ $car->name }} - Image {{ $index + 1 }}"
                                                    class="w-full h-full object-cover object-center cursor-pointer hover:scale-105 transition-transform duration-500"
                                                    onclick="openFullscreen({{ $index }})">

                                                <!-- Gradient Overlay -->
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent pointer-events-none">
                                                </div>

                                                <!-- Image Content -->
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 p-6 md:p-8 lg:p-10 text-white z-20 pointer-events-none">
                                                    <!-- Image Counter -->
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <span
                                                            class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                                            Image {{ $index + 1 }} of {{ $car->images->count() }}
                                                        </span>

                                                        
                                                    </div>

                                                    <!-- Car Details -->
                                                    <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2">
                                                        {{ $car->name }}</h3>
                                                    <p class="text-base md:text-lg text-gray-200 flex items-center gap-2">
                                                        <i class="fas fa-car"></i>
                                                        {{ $car->brand }} {{ $car->model }} ({{ $car->year }})
                                                    </p>

                                                    <!-- Price Badge -->
                                                    <div
                                                        class="mt-4 inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                                                        <span
                                                            class="text-lg font-bold">${{ number_format($car->price_per_day, 0) }}</span>
                                                        <span class="text-sm">/day</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Navigation Arrows -->
                                        <button onclick="prevSlide()"
                                            class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition-all z-20 opacity-0 group-hover:opacity-100">
                                            <i class="fas fa-chevron-left text-lg md:text-xl"></i>
                                        </button>

                                        <button onclick="nextSlide()"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition-all z-20 opacity-0 group-hover:opacity-100">
                                            <i class="fas fa-chevron-right text-lg md:text-xl"></i>
                                        </button>

                                        <!-- Dots Indicator -->
                                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-20">
                                            @foreach ($car->images as $index => $image)
                                                <button onclick="goToSlide({{ $index }})"
                                                    class="w-2 h-2 md:w-3 md:h-3 rounded-full transition-all duration-300 dot-indicator {{ $index === 0 ? 'bg-white w-4 md:w-6' : 'bg-white/50' }}"
                                                    data-dot="{{ $index }}"></button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>


                        </div>

                        <!-- Car Info -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900">{{ $car->brand }} {{ $car->model }}
                                    </h1>
                                    <p class="text-gray-500 mt-1">{{ $car->year }} • {{ $car->car_type }}
                                    </p>
                                </div>
                                
                            </div>

                            @if ($car->description)
                                <p class="text-gray-600 border-t border-gray-100 pt-4 mt-2">{{ $car->description }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Features / Specs -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Vehicle Features</h2>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <!-- Transmission -->
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-cog text-slate-700"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Transmission</p>
                                    <p class="font-medium text-gray-900">{{ $car->transmission }}</p>
                                </div>
                            </div>

                            <!-- Seats -->
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-slate-700"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Seater</p>
                                    <p class="font-medium text-gray-900">{{ $car->seats }} Seater</p>
                                </div>
                            </div>

                            <!-- Fuel Type -->
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-gas-pump text-slate-700"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Fuel</p>
                                    <p class="font-medium text-gray-900">{{ $car->fuel_type }}</p>
                                </div>
                            </div>

                            <!-- RFID -->
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-wifi text-slate-700"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">RFID</p>
                                    <p class="font-medium text-gray-900">{{ $car->rfid_type ?? 'Standard' }}</p>
                                </div>
                            </div>

                            <!-- Year -->
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar text-slate-700"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Year</p>
                                    <p class="font-medium text-gray-900">{{ $car->year }}</p>
                                </div>
                            </div>

                            <!-- Availability -->
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check-circle text-slate-700"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Status</p>
                                    @if ($car->is_available)
                                        <p class="font-medium text-green-600">Available</p>
                                    @else
                                        <p class="font-medium text-red-600">Unavailable</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Booking Form -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 sticky top-24">

                        <!-- Price -->
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex items-baseline justify-between">
                                <span class="text-3xl font-bold text-gray-900">PHP
                                    {{ number_format($car->price_per_day, 0) }}</span>
                                <span class="text-gray-500">/ day</span>
                            </div>
                        </div>

                        <!-- Booking Form -->
                        <form action="{{ route('booking.store') }}" method="POST" class="p-6 space-y-4">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">

                            <!-- Pickup Date -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-alt mr-2 text-slate-600"></i>Pickup Date
                                </label>
                                <input type="date" name="start_date" id="start_date" min="{{ date('Y-m-d') }}"
                                    required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-slate-700 focus:ring-2 focus:ring-slate-200 outline-none transition">
                            </div>

                            <!-- Return Date -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-check mr-2 text-slate-600"></i>Return Date
                                </label>
                                <input type="date" name="end_date" id="end_date"
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-slate-700 focus:ring-2 focus:ring-slate-200 outline-none transition">
                            </div>
                            <!-- Payment Method -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-credit-card mr-2 text-slate-600"></i>Payment Method
                                </label>
                                <div class="grid grid-cols-2 gap-2">
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="cash" class="mr-2"
                                            checked>
                                        <span>Cash</span>
                                    </label>

                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="gcash" class="mr-2">
                                        <span>GCash</span>
                                    </label>

                                </div>
                            </div>

                            <!-- Special Requests -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-comment mr-2 text-slate-600"></i>Special Requests
                                </label>
                                <textarea name="special_requests" rows="2" placeholder="Any special requests? (optional)"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-slate-700 focus:ring-2 focus:ring-slate-200 outline-none transition resize-none"></textarea>
                            </div>

                            <!-- Price Summary (Dynamic via JS) -->
                            <div id="price-summary" class="border-t border-gray-100 pt-4 mt-2 hidden">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Daily rate</span>
                                    <span class="font-medium">PHP{{ number_format($car->price_per_day, 0) }}</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Number of days</span>
                                    <span class="font-medium" id="days-count">0</span>
                                </div>
                                <div class="flex justify-between text-lg font-bold">
                                    <span>Total</span>
                                    <span id="total-price">0</span>
                                </div>
                            </div>

                            <!-- Book Button -->
                            @if ($car->is_available)
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-slate-700 to-slate-900 hover:from-slate-800 hover:to-slate-950 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-md hover:shadow-xl mt-4">
                                    Confirm Booking
                                </button>
                            @else
                                <button type="button" disabled
                                    class="w-full bg-gray-300 text-gray-500 font-bold py-4 px-6 rounded-xl cursor-not-allowed mt-4">
                                    Unavailable
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <!-- Similar Cars (Optional) -->
            @if (isset($similarCars) && $similarCars->count() > 0)
                <div class="mt-16">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Similar Cars</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($similarCars as $similar)
                            <a href="{{ route('car.show', $similar->id) }}"
                                class="bg-white rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 overflow-hidden group">
                                <div
                                    class="h-40 bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                    <i class="fas fa-car text-4xl text-slate-600 group-hover:scale-110 transition"></i>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-bold text-gray-900">{{ $similar->brand }}
                                                {{ $similar->model }}</h3>
                                            <p class="text-sm text-gray-500">{{ $similar->year }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="font-bold text-slate-700">PHP
                                                {{ number_format($similar->price_per_day, 0) }}</span>
                                            <span class="text-xs text-gray-500">/day</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
<!-- Fullscreen Modal -->
<div id="fullscreenModal" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-xl" onclick="closeFullscreen()">
    <div class="absolute top-4 right-4 flex gap-2 z-50">
        <button onclick="downloadImage()" class="bg-white/10 hover:bg-white/20 text-white w-10 h-10 rounded-full flex items-center justify-center transition">
            <i class="fas fa-download"></i>
        </button>
        <button onclick="closeFullscreen()" class="bg-white/10 hover:bg-white/20 text-white w-10 h-10 rounded-full flex items-center justify-center transition">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full flex items-center justify-center">
        <!-- Main Fullscreen Image -->
        <img id="fullscreenImage" src="" alt="Fullscreen view" class="max-w-full max-h-full object-contain">
        
        <!-- Fullscreen Navigation -->
        <button onclick="fullscreenPrev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 text-white w-12 h-12 rounded-full flex items-center justify-center transition">
            <i class="fas fa-chevron-left text-2xl"></i>
        </button>
        
        <button onclick="fullscreenNext()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 text-white w-12 h-12 rounded-full flex items-center justify-center transition">
            <i class="fas fa-chevron-right text-2xl"></i>
        </button>
    </div>
    
    <!-- Image Info in Fullscreen -->
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/50 backdrop-blur-md text-white px-4 py-2 rounded-full text-sm flex items-center gap-4">
        <span id="fullscreenCounter"></span>
        <span class="w-px h-4 bg-white/30"></span>
        <span id="fullscreenFilename"></span>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Carousel variables
        window.currentSlide = 0;
        window.fullscreenIndex = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.dot-indicator');
        const totalSlides = slides.length;
        
        // Get all image paths for fullscreen
        window.images = @json($car->images->map(function($image) {
            return [
                'path' => Storage::url($image->image_path),
                'name' => $image->image_path,
                'is_primary' => $image->is_primary
            ];
        }));

        // Hide all slides except first
        slides.forEach((slide, index) => {
            if (index !== 0) {
                slide.classList.add('opacity-0');
                slide.classList.remove('opacity-100', 'z-10');
            } else {
                slide.classList.add('opacity-100', 'z-10');
            }
        });

        // Show slide function
        window.showSlide = function(index) {
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;
            
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('opacity-0', 'z-0');
                    slide.classList.add('opacity-100', 'z-10');
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0', 'z-0');
                }
            });
            
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('bg-white/50', 'w-2', 'md:w-3');
                    dot.classList.add('bg-white', 'w-4', 'md:w-6');
                } else {
                    dot.classList.remove('bg-white', 'w-4', 'md:w-6');
                    dot.classList.add('bg-white/50', 'w-2', 'md:w-3');
                }
            });
            
            window.currentSlide = index;
        };

        window.nextSlide = function() {
            showSlide(currentSlide + 1);
        };

        window.prevSlide = function() {
            showSlide(currentSlide - 1);
        };

        window.goToSlide = function(index) {
            showSlide(index);
        };

        // Auto advance slides
        let autoAdvance = setInterval(nextSlide, 5000);
        const carousel = document.querySelector('.group');
        
        carousel.addEventListener('mouseenter', () => {
            clearInterval(autoAdvance);
        });

        carousel.addEventListener('mouseleave', () => {
            autoAdvance = setInterval(nextSlide, 5000);
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                if (document.getElementById('fullscreenModal').classList.contains('hidden')) {
                    prevSlide();
                } else {
                    fullscreenPrev();
                }
            } else if (e.key === 'ArrowRight') {
                if (document.getElementById('fullscreenModal').classList.contains('hidden')) {
                    nextSlide();
                } else {
                    fullscreenNext();
                }
            } else if (e.key === 'Escape') {
                closeFullscreen();
            }
        });
    });

    // Fullscreen functions
    function openFullscreen(index) {
        window.fullscreenIndex = index;
        const modal = document.getElementById('fullscreenModal');
        const fullscreenImage = document.getElementById('fullscreenImage');
        const counter = document.getElementById('fullscreenCounter');
        const filename = document.getElementById('fullscreenFilename');
        
        fullscreenImage.src = window.images[index].path;
        counter.textContent = `Image ${index + 1} of ${window.images.length}`;
        filename.textContent = window.images[index].name.split('/').pop();
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeFullscreen() {
        document.getElementById('fullscreenModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function fullscreenNext() {
        window.fullscreenIndex = (window.fullscreenIndex + 1) % window.images.length;
        updateFullscreenImage();
    }

    function fullscreenPrev() {
        window.fullscreenIndex = (window.fullscreenIndex - 1 + window.images.length) % window.images.length;
        updateFullscreenImage();
    }

    function updateFullscreenImage() {
        const fullscreenImage = document.getElementById('fullscreenImage');
        const counter = document.getElementById('fullscreenCounter');
        const filename = document.getElementById('fullscreenFilename');
        
        fullscreenImage.src = window.images[window.fullscreenIndex].path;
        counter.textContent = `Image ${window.fullscreenIndex + 1} of ${window.images.length}`;
        filename.textContent = window.images[window.fullscreenIndex].name.split('/').pop();
    }

    function downloadImage() {
        const link = document.createElement('a');
        link.href = window.images[window.fullscreenIndex].path;
        link.download = window.images[window.fullscreenIndex].name.split('/').pop();
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Prevent modal close when clicking on image
    document.getElementById('fullscreenImage').addEventListener('click', function(e) {
        e.stopPropagation();
    });





        document.addEventListener('DOMContentLoaded', function() {
            const pickupDate = document.getElementById('start_date');
            const returnDate = document.getElementById('end_date');
            const priceSummary = document.getElementById('price-summary');
            const daysCount = document.getElementById('days-count');
            const totalPrice = document.getElementById('total-price');
            const dailyRate = {{ $car->price_per_day }};

            function calculateDays() {
                if (pickupDate.value && returnDate.value) {
                    const start = new Date(pickupDate.value);
                    const end = new Date(returnDate.value);
                    const diffTime = end - start;
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

                    if (diffDays > 0) {
                        daysCount.textContent = diffDays;
                        totalPrice.textContent = '$' + (diffDays * dailyRate).toLocaleString();
                        priceSummary.classList.remove('hidden');

                        // Set return date min
                        const nextDay = new Date(start);
                        nextDay.setDate(nextDay.getDate() + 1);
                        returnDate.min = nextDay.toISOString().split('T')[0];
                    }
                }
            }

            pickupDate.addEventListener('change', calculateDays);
            returnDate.addEventListener('change', calculateDays);
        });
</script>
<style>
        /* Smooth transitions */
        .carousel-slide {
            transition: opacity 0.7s ease-in-out;
        }

        /* Dot hover effect */
        .dot-indicator {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot-indicator:hover {
            background-color: white;
            transform: scale(1.2);
        }

        /* Navigation arrows */
        .group:hover .opacity-0 {
            opacity: 1 !important;
        }

        /* Smooth transitions */
        .carousel-slide {
            transition: opacity 0.7s ease-in-out;
        }

        /* Dot hover effect */
        .dot-indicator {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot-indicator:hover {
            background-color: white;
            transform: scale(1.2);
        }

        /* Navigation arrows */
        .group:hover .opacity-0 {
            opacity: 1 !important;
        }

        /* Fullscreen modal animation */
        #fullscreenModal {
            transition: opacity 0.3s ease;
        }

        #fullscreenModal.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #fullscreenModal:not(.hidden) {
            opacity: 1;
            pointer-events: all;
        }

        /* Fullscreen image hover effect */
        #fullscreenImage {
            transition: transform 0.3s ease;
        }

        #fullscreenImage:hover {
            transform: scale(1.02);
        }
</style>
@endsection

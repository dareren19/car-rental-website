@extends('admin.layouts.admin')

@section('content')
    <!-- Car Detail Page - Show Only -->
    <div class="bg-gray-50 min-h-screen py-8 md:py-12">
    <div class="container mx-auto px-4 lg:px-8">
        {{-- The container already provides max-width and centering --}}
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- gap-8 adds spacing between columns --}}
            
            <!-- LEFT: Car Image Gallery -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                    <!-- Main Carousel -->
                    @if ($car->images->isEmpty())
                        <!-- No Image Fallback -->
                        <div class="relative h-96 md:h-[500px] bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-car text-8xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">No images available</p>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent text-white p-6">
                                <h3 class="text-2xl font-bold">{{ $car->brand }} {{ $car->model }}</h3>
                                <p class="text-gray-200">{{ $car->year }}</p>
                            </div>
                        </div>
                    @else
                        <!-- Image Carousel -->
                        <div class="relative h-96 md:h-[500px] lg:h-[550px] overflow-hidden group" id="carouselContainer">
                            <!-- Slides -->
                            @foreach ($car->images as $index => $image)
                                <div class="carousel-slide absolute inset-0 transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
                                     data-slide="{{ $index }}">
                                    <img src="{{ Storage::url($image->image_path) }}"
                                         alt="{{ $car->brand }} {{ $car->model }} - Image {{ $index + 1 }}"
                                         class="w-full h-full object-cover object-center cursor-zoom-in"
                                         onclick="openFullscreen({{ $index }})"
                                         loading="lazy">

                                    <!-- Image Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none"></div>

                                    <!-- Image Info Overlay -->
                                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                                <i class="fas fa-image mr-1"></i>
                                                {{ $index + 1 }} / {{ $car->images->count() }}
                                            </span>
                                            
                                            @if($image->is_primary)
                                                <span class="bg-yellow-500 text-yellow-900 px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                                                    <i class="fas fa-crown text-xs"></i>
                                                    Primary
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Navigation Arrows -->
                            @if($car->images->count() > 1)
                                <button onclick="prevSlide()" 
                                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition-all duration-300 z-20 opacity-0 group-hover:opacity-100 hover:scale-110">
                                    <i class="fas fa-chevron-left text-lg md:text-lg"></i>
                                </button>
                                
                                <button onclick="nextSlide()" 
                                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition-all duration-300 z-20 opacity-0 group-hover:opacity-100 hover:scale-110">
                                    <i class="fas fa-chevron-right text-lg md:text-lg"></i>
                                </button>
                            @endif

                            <!-- Dots Indicator -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-20">
                                @foreach ($car->images as $index => $image)
                                    <button onclick="goToSlide({{ $index }})" 
                                            class="w-2 h-2 md:w-2.5 md:h-2.5 rounded-full transition-all duration-300 dot-indicator {{ $index === 0 ? 'bg-white w-4 md:w-5' : 'bg-white/60 hover:bg-white/80' }}"
                                            data-dot="{{ $index }}"
                                            aria-label="Go to image {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Thumbnail Strip -->
                        @if($car->images->count() > 1)
                            <div class="grid grid-cols-6 gap-2 p-3 bg-gray-50 border-t border-gray-100">
                                @foreach($car->images as $index => $image)
                                    <button onclick="goToSlide({{ $index }})" 
                                            class="relative group/thumb focus:outline-none">
                                        <img src="{{ Storage::url($image->image_path) }}" 
                                             class="w-full h-16 object-cover rounded-lg transition-all duration-300 {{ $index === 0 ? 'ring-2 ring-blue-500' : 'ring-1 ring-gray-300 group-hover/thumb:ring-blue-300' }}">
                                        
                                        @if($image->is_primary)
                                            <span class="absolute -top-1 -right-1 bg-blue-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center border-2 border-white">
                                                <i class="fas fa-star text-[10px]"></i>
                                            </span>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    @endif
                    
                    <!-- Features / Specs -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 border-t border-gray-100">
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
            </div>

            <!-- RIGHT: Car Details Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Details</h2>
                        <div class="space-y-4">
                            <div class="flex items-baseline justify-between">
                                <span class="text-gray-600">Brand</span>
                                <span class="font-semibold text-gray-900">{{ $car->brand }}</span>
                            </div>
                            <div class="flex items-baseline justify-between">
                                <span class="text-gray-600">Model</span>
                                <span class="font-semibold text-gray-900">{{ $car->model }}</span>
                            </div>
                            <div class="flex items-baseline justify-between">
                                <span class="text-gray-600">Year</span>
                                <span class="font-semibold text-gray-900">{{ $car->year }}</span>
                            </div>
                            <div class="flex items-baseline justify-between">
                                <span class="text-gray-600">Car Type</span>
                                <span class="font-semibold text-gray-900">{{ $car->car_type ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    @if($car->description)
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-2">Description</h3>
                        <p class="text-gray-600 text-sm">{{ $car->description }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Fullscreen Modal -->
    <div id="fullscreenModal" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-xl" onclick="closeFullscreen()">
        <div class="absolute top-4 right-4 flex gap-2 z-50">
            <button onclick="downloadImage()"
                    class="bg-white/10 hover:bg-white/20 text-white w-10 h-10 rounded-full flex items-center justify-center transition">
                <i class="fas fa-download"></i>
            </button>
            <button onclick="closeFullscreen()"
                    class="bg-white/10 hover:bg-white/20 text-white w-10 h-10 rounded-full flex items-center justify-center transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full flex items-center justify-center">
            <img id="fullscreenImage" src="" alt="Fullscreen view" class="max-w-full max-h-full object-contain">
            
            @if($car->images->count() > 1)
                <button onclick="fullscreenPrev()"
                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 text-white w-12 h-12 rounded-full flex items-center justify-center transition">
                    <i class="fas fa-chevron-left text-2xl"></i>
                </button>

                <button onclick="fullscreenNext()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 text-white w-12 h-12 rounded-full flex items-center justify-center transition">
                    <i class="fas fa-chevron-right text-2xl"></i>
                </button>
            @endif
        </div>

        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/50 backdrop-blur-md text-white px-4 py-2 rounded-full text-sm flex items-center gap-4">
            <span id="fullscreenCounter"></span>
            <span class="w-px h-4 bg-white/30"></span>
            <span id="fullscreenFilename"></span>
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Only initialize if there are images
    @if(!$car->images->isEmpty())
    
    // Carousel variables
    window.currentSlide = 0;
    window.fullscreenIndex = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.dot-indicator');
    const thumbnails = document.querySelectorAll('[onclick^="goToSlide"]');
    const totalSlides = slides.length;
    
    // Get all image paths for fullscreen
    window.images = @json($car->images->map(function($image) {
        return [
            'path' => Storage::url($image->image_path),
            'name' => basename($image->image_path),
            'is_primary' => $image->is_primary
        ];
    }));

    // Show slide function
    window.showSlide = function(index) {
        if (index < 0) index = totalSlides - 1;
        if (index >= totalSlides) index = 0;
        
        // Update slides
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.remove('opacity-0', 'z-0');
                slide.classList.add('opacity-100', 'z-10');
            } else {
                slide.classList.remove('opacity-100', 'z-10');
                slide.classList.add('opacity-0', 'z-0');
            }
        });
        
        // Update dots
        dots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.remove('bg-white/60', 'w-2', 'md:w-2.5');
                dot.classList.add('bg-white', 'w-4', 'md:w-5');
            } else {
                dot.classList.remove('bg-white', 'w-4', 'md:w-5');
                dot.classList.add('bg-white/60', 'w-2', 'md:w-2.5');
            }
        });
        
        // Update thumbnails ring
        if (thumbnails.length > 0) {
            thumbnails.forEach((thumb, i) => {
                const img = thumb.querySelector('img');
                if (img) {
                    if (i === index) {
                        img.classList.remove('ring-1', 'ring-gray-300');
                        img.classList.add('ring-2', 'ring-blue-500');
                    } else {
                        img.classList.remove('ring-2', 'ring-blue-500');
                        img.classList.add('ring-1', 'ring-gray-300');
                    }
                }
            });
        }
        
        window.currentSlide = index;
    };

    // Navigation functions
    window.nextSlide = function() {
        showSlide(currentSlide + 1);
    };

    window.prevSlide = function() {
        showSlide(currentSlide - 1);
    };

    window.goToSlide = function(index) {
        showSlide(index);
    };

    // Auto advance slides every 5 seconds
    let autoAdvance = setInterval(nextSlide, 5000);
    const carousel = document.getElementById('carouselContainer');
    
    if (carousel) {
        carousel.addEventListener('mouseenter', () => {
            clearInterval(autoAdvance);
        });

        carousel.addEventListener('mouseleave', () => {
            autoAdvance = setInterval(nextSlide, 5000);
        });
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        const modal = document.getElementById('fullscreenModal');
        if (modal.classList.contains('hidden')) {
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                prevSlide();
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                nextSlide();
            }
        } else {
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                fullscreenPrev();
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                fullscreenNext();
            } else if (e.key === 'Escape') {
                closeFullscreen();
            }
        }
    });

    // Fullscreen functions
    window.openFullscreen = function(index) {
        window.fullscreenIndex = index;
        const modal = document.getElementById('fullscreenModal');
        const fullscreenImage = document.getElementById('fullscreenImage');
        const counter = document.getElementById('fullscreenCounter');
        const filename = document.getElementById('fullscreenFilename');

        fullscreenImage.src = window.images[index].path;
        counter.textContent = `Image ${index + 1} of ${window.images.length}`;
        filename.textContent = window.images[index].name;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    window.closeFullscreen = function() {
        document.getElementById('fullscreenModal').classList.add('hidden');
        document.body.style.overflow = '';
    };

    window.fullscreenNext = function() {
        window.fullscreenIndex = (window.fullscreenIndex + 1) % window.images.length;
        updateFullscreenImage();
    };

    window.fullscreenPrev = function() {
        window.fullscreenIndex = (window.fullscreenIndex - 1 + window.images.length) % window.images.length;
        updateFullscreenImage();
    };

    window.updateFullscreenImage = function() {
        const fullscreenImage = document.getElementById('fullscreenImage');
        const counter = document.getElementById('fullscreenCounter');
        const filename = document.getElementById('fullscreenFilename');

        fullscreenImage.src = window.images[window.fullscreenIndex].path;
        counter.textContent = `Image ${window.fullscreenIndex + 1} of ${window.images.length}`;
        filename.textContent = window.images[window.fullscreenIndex].name;
    };

    window.downloadImage = function() {
        const link = document.createElement('a');
        link.href = window.images[window.fullscreenIndex].path;
        link.download = window.images[window.fullscreenIndex].name;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    };

    // Prevent modal close when clicking on image
    const fullscreenImage = document.getElementById('fullscreenImage');
    if (fullscreenImage) {
        fullscreenImage.addEventListener('click', (e) => e.stopPropagation());
    }
    
    @endif
});
</script>
@endsection

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

/* Thumbnail hover effect */
.group\/thumb:hover img {
    transform: scale(1.05);
}

/* Sticky sidebar on desktop */
@media (min-width: 1024px) {
    .lg\:sticky {
        position: sticky;
        top: 1.5rem;
    }
}
</style>
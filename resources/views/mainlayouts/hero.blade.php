<section id="home" class="relative bg-gradient-to-r from-slate-700 to-slate-900 min-h-screen flex items-center">
    <div class="container mx-auto px-6 lg:px-8 py-32">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
            <!-- Left Content -->
            <div class="flex-1 text-center lg:text-left">
                <!-- AUTO RENTAL SERVICE -->
                <p class="text-slate-300 text-lg font-semibold mb-4 tracking-wider uppercase">
                    Auto Rental Service
                </p>

                <!-- Find The Best Car For Rent Today! -->
                <h1 class="text-4xl lg:text-6xl font-extrabold text-white mb-6 leading-tight">
                    Find The Best Car <br>For Rent Today!
                </h1>

                @if ($featuredCar)
                    <!-- DYNAMIC CAR CARD - FROM DATABASE -->
                    <div
                        class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 max-w-md mx-auto lg:mx-0 border border-white/20">
                        <!-- STARTING FROM text -->
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-white/80 text-sm font-semibold uppercase tracking-wider">Starting
                                From</span>
                            @if ($featuredCar->is_featured)
                                <span class="bg-white/20 px-4 py-1 rounded-full text-white text-sm">Featured</span>
                            @endif
                        </div>

                        <!-- CAR NAME and PRICE - DYNAMIC -->
                        <div class="flex items-end justify-between">
                            <div>
                                <h2 class="text-white text-4xl font-black mb-2 uppercase">
                                    {{ $featuredCar->brand }} {{ $featuredCar->model }}
                                </h2>
                                <div class="flex items-baseline gap-1">
                                    <span
                                        class="text-white text-5xl font-black">{{ number_format($featuredCar->price_per_day, 0) }}</span>
                                    <span class="text-white/70 text-lg">/day</span>
                                </div>
                                <!-- Year Display -->
                                <p class="text-white/60 text-sm mt-2">{{ $featuredCar->year }} •
                                    {{ $featuredCar->fuel_type }} • {{ $featuredCar->transmission }}</p>
                            </div>
                            <div class="bg-white/20 p-4 rounded-2xl">
                                <i class="fas fa-car text-white text-4xl"></i>
                            </div>
                        </div>

                        <!-- BOOK NOW button - Dynamic Car ID -->
                        <button onclick="bookCar({{ $featuredCar->id }})"
                            class="w-full mt-6 bg-white text-slate-800 px-8 py-4 rounded-full font-bold hover:bg-slate-100 hover:shadow-xl hover:scale-105 transition-all duration-300 uppercase tracking-wider">
                            Book {{ $featuredCar->brand }} {{ $featuredCar->model }} Now!
                        </button>
                    </div>
                @else
                    <!-- FALLBACK CARD IF NO CARS IN DATABASE -->
                    <div
                        class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 max-w-md mx-auto lg:mx-0 border border-white/20">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-white/80 text-sm font-semibold uppercase tracking-wider">Starting
                                From</span>
                        </div>
                        <div class="flex items-end justify-between">
                            <div>
                                <h2 class="text-white text-4xl font-black mb-2 uppercase">No Cars Available</h2>
                                <div class="flex items-baseline gap-1">
                                    {{-- <span class="text-white text-5xl font-black">0</span>
                                    <span class="text-white/70 text-lg">/day</span> --}}
                                </div>
                            </div>
                        </div>
                        <button
                            class="w-full mt-6 bg-white text-slate-800 px-8 py-4 rounded-full font-bold opacity-50 cursor-not-allowed"
                            disabled>
                            Check Back Later
                        </button>
                    </div>
                @endif

                <!-- Stats -->
                <div class="flex justify-center lg:justify-start gap-8 mt-12">
                    <div>
                        <p class="text-white text-2xl font-bold">{{ $cars->count() }}+</p>
                        <p class="text-slate-300">Available Cars</p>
                    </div>
                    <div>
                        <p class="text-white text-2xl font-bold">{{ $cars->unique('brand')->count() }}+</p>
                        <p class="text-slate-300">Units</p>
                    </div>
                    <div>
                        <p class="text-white text-2xl font-bold">100+</p>
                        <p class="text-slate-300">Happy Clients</p>
                    </div>
                </div>
            </div>

            <!-- Right Image - Dynamic based on featured car -->
            <div class="flex-1 relative">
                <div class="relative animate-float">
                    @if ($featuredCar)
                        @if($featuredCar->model == 'Vios')
                            <img src="https://toyotalongphuoc.com/wp-content/uploads/2021/03/thiet-ke-xe-toyota-vios-e-mt-2021-toyotalongphuoc-vn.png.webp"
                                alt="Vios" class="relative z-10 w-full max-w-2xl mx-auto"> 
                        @elseif($featuredCar->model == 'Innova')
                            <img src="https://www.pngkey.com/png/full/253-2531779_2018-toyota-innova-and-fortuner-toyota-innova.png"
                                alt="Innova" class="relative z-10 w-full max-w-2xl mx-auto">
                        @elseif($featuredCar->model == 'Mirage')
                            <img src="https://autobrand.weebly.com/uploads/8/2/9/9/82994880/color-red_4_orig.png"
                                alt="Mirage" class="relative z-10 w-full max-w-2xl mx-auto">
                        @elseif($featuredCar->model == 'Navarra')
                            <img src="https://dodomat.com.my/cdn/shop/files/car-mats-nissan-navara-2015-present-d23_2a615d38-0682-44eb-8b8c-1880adce478f.png?v=1732865397"
                                alt="Navarra" class="relative z-10 w-full max-w-2xl mx-auto">                                     
                        @else
                            <img src="https://www.mitsubishi-motors.com.ph/content/dam/mitsubishi-motors-ph/images/cars/montero-sport/2020/primary/exterior/kr1wgupfpl-ge-e92/U25_45_20QX-GT2WD.png?width=1080&quality=70"
                                alt="Montero" class="relative z-10 w-full max-w-2xl mx-auto">
                        @endif
                    
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 w-full">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 240">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>
</section>

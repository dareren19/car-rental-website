@extends('layouts.app')

@section('content')
    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <nav class="mb-6">
            <ol class="flex items-center gap-2 text-sm">
                <li><a href="{{ url('/') }}" class="text-slate-500 hover:text-slate-600">Home</a></li>
                <li class="text-slate-400">/</li>
                <li class="font-medium text-slate-900">Cars</li>
            </ol>
        </nav>

        <div class="flex items-center justify-between mb-4 pt-8">
            <div>
                <h1 class="text-slate-900 font-bold text-xl">Cars available</h1>
                <p class="mt-1 text-sm text-slate-500">{{ $cars->total() }} car{{ $cars->total() != 1 ? 's' : '' }} found.</p>
            </div>

            {{-- Mobile filter toggle --}}
            <button type="button" onclick="toggleFilters()"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 transition-colors bg-white border border-gray-300 rounded-lg lg:hidden hover:bg-gray-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M3 12h18M3 20h18" />
                </svg>
                Filters
            </button>
        </div>

        <div class="flex gap-8">

            {{-- Sidebar filters --}}
            <aside id="filterSidebar"
                class="fixed inset-y-0 left-0 z-40 w-72 bg-white p-6 shadow-xl transform -translate-x-full transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0 lg:w-64 lg:shadow-none lg:block">
                <div class="hidden mb-6 lg:flex lg:items-center lg:justify-between font-semibold text-slate-900">
                    <h2 class="text-slate-900 font-semibold text-xl ">Filters</h2>
                    @if (count($filters) > 0)
                        <a href="{{ route('car.listing') }}"
                            class="text-sm text-slate-600 hover:text-slate-700">Clear</a>
                    @endif
                </div>

                <div class="space-y-6">

                    {{-- Car type --}}
                    <div>
                        <h3 class="mb-3 text-sm font-semibold text-slate-900">Car type</h3>
                        <div class="space-y-2">
                            @foreach ($car_types as $car_type)
                                <form method="GET" class="flex items-center gap-2 cursor-pointer">
                                    <input type="hidden" name="car_type" value="{{ $car_type }}">
                                    @foreach ($filters as $k => $v)
                                        @if ($k != 'car_type')
                                            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                        @endif
                                    @endforeach
                                    <button type="submit"
                                        class=" px-4 flex items-center gap-2 cursor-pointer text-sm text-slate-800 {{ ($filters['car_type'] ?? '') === $car_type ? 'font-semibold text-slate-600' : '' }}">
                                        {{ $car_type }}
                                    </button>
                                </form>
                            @endforeach
                            {{-- @if (isset($filters['car_type']))
                                <a href="{{ url('car-listing', array_diff_key($filters, ['car_type' => 1])) }}"
                                    class="text-sm text-slate-600 hover:text-slate-700 block mt-1">Clear</a>
                            @endif --}}
                        </div>
                    </div>

                    {{-- Car Transmission --}}
                    <div>
                        <h3 class="mb-3 text-sm font-semibold text-slate-900">Transmission</h3>
                        <div class="space-y-2">
                            @foreach ($transmissions as $transmission)
                                <form method="GET" class="flex items-center gap-2 cursor-pointer">
                                    <input type="hidden" name="transmission" value="{{ $transmission }}">
                                    @foreach ($filters as $k => $v)
                                        @if ($k != 'transmission')
                                            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                        @endif
                                    @endforeach
                                    <button type="submit"
                                        class="px-4 flex items-center gap-2 cursor-pointer text-sm text-slate-800 {{ ($filters['transmission'] ?? '') === $transmission ? 'font-semibold text-slate-600' : '' }}">
                                        {{ $transmission }}
                                    </button>
                                </form>
                            @endforeach
                            
                        </div>
                    </div>

                    {{-- RFID Tag --}}
                    <div>
                        <h3 class="mb-3 text-sm font-semibold text-slate-900">RFID sticker</h3>
                        <div class="space-y-2">
                            @foreach ($rfid_types as $rfid_type)
                                <form method="GET" class="flex items-center gap-2 cursor-pointer">
                                    <input type="hidden" name="rfid_type" value="{{ $rfid_type }}">
                                    @foreach ($filters as $k => $v)
                                        @if ($k != 'rfid_type')
                                            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                        @endif
                                    @endforeach
                                    <button type="submit"
                                        class="px-4 flex items-center gap-2 cursor-pointer text-sm text-slate-800 {{ ($filters['rfid_type'] ?? '') === $rfid_type ? 'font-semibold text-slate-600' : '' }}">
                                        {{ $rfid_type }}
                                    </button>
                                </form>
                            @endforeach
                            
                        </div>
                    </div>
                </div>

            </aside>

            {{-- Overlay for mobile --}}
            <div id="filterOverlay" class="fixed inset-0 z-30 bg-black/30 hidden lg:hidden" onclick="toggleFilters()"></div>

            {{-- Products --}}
            <div class="flex-1">
                @if ($cars->isEmpty())
                    <div class="py-12 text-center">
                        <p>No product found.</p>
                        <a href="{{ route('car.listing') }}" class="mt-4 text-sm text-slate-600 hover:text-slate-700 block">Clear
                            filters</a>
                    </div>
                @else
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($cars as $car)
                            @include('cars.car-card', ['car' => $car])
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-8">
                    {{ $cars->withQueryString()->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>

    {{-- Vanilla JS for mobile filters --}}
    <script>
        function toggleFilters() {
            const sidebar = document.getElementById('filterSidebar');
            const overlay = document.getElementById('filterOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

@endsection

@extends('admin.layouts.admin')

@section('content')

<div class="px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header Section -->
    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">All Bookings</h1>
        
        <!-- Optional: Add filter/search button -->
        {{-- <div class="mt-4 sm:mt-0">
            <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                </svg>
                Filter
            </button>
        </div> --}}
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 rounded-md bg-red-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Table Section - Responsive Card Layout for Mobile -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Desktop View (hidden on mobile) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User & Car Details</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking Period</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pricing</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</div>
                            <div class="text-sm text-gray-500">
                                {{ $booking->car->brand }} {{ $booking->car->model }} ({{ $booking->car->year }})
                            </div>
                            <div class="text-xs text-gray-400 mt-1">
                                {{ $booking->car->transmission }} • {{ $booking->car->fuel_type }} • {{ $booking->car->car_type }}
                                @if($booking->car->rfid_type)
                                    • RFID: {{ $booking->car->rfid_type }}
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <span class="font-medium">From:</span> {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}
                            </div>
                            <div class="text-sm text-gray-900">
                                <span class="font-medium">To:</span> {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ $booking->total_days }} {{ Str::plural('day', $booking->total_days) }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">PHP {{ number_format($booking->car->price_per_day, 2) }}/day</div>
                            <div class="text-sm font-semibold text-gray-900">Total: PHP {{ number_format($booking->total_price, 2) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($booking->status == 'pending')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($booking->status == 'approved')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Approved
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Rejected
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($booking->status == 'pending')
                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('admin.bookings.approve', $booking->id) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                            Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.bookings.reject', $booking->id) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-sm text-gray-400">No action needed</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile View (Card Layout) -->
        <div class="md:hidden">
            @forelse($bookings as $booking)
                <div class="p-4 border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition-colors">
                    <!-- Header with User and Status -->
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">{{ $booking->user->name }}</h3>
                            <p class="text-xs text-gray-500">Booking #{{ $booking->id }}</p>
                        </div>
                        <div>
                            @if($booking->status == 'pending')
                                <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($booking->status == 'approved')
                                <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-green-100 text-green-800">
                                    Approved
                                </span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-red-100 text-red-800">
                                    Rejected
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Car Details -->
                    <div class="bg-gray-50 rounded p-3 mb-3">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-900">{{ $booking->car->brand }} {{ $booking->car->model }}</span>
                            <span class="text-xs text-gray-500">{{ $booking->car->year }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-xs text-gray-600">
                            <div>{{ $booking->car->transmission }}</div>
                            <div>{{ $booking->car->fuel_type }}</div>
                            <div>{{ $booking->car->car_type }}</div>
                            @if($booking->car->rfid_type)
                                <div>RFID: {{ $booking->car->rfid_type }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Booking Dates -->
                    <div class="flex justify-between items-center mb-3 text-sm">
                        <div>
                            <span class="text-xs text-gray-500 block">From</span>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</span>
                        </div>
                        <div class="text-gray-400">→</div>
                        <div>
                            <span class="text-xs text-gray-500 block">To</span>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="flex justify-between items-center mb-4 p-2 bg-blue-50 rounded">
                        <div>
                            <span class="text-xs text-gray-600 block">PHP {{ number_format($booking->car->price_per_day, 2) }}/day</span>
                            <span class="text-xs text-gray-500">{{ $booking->total_days }} days</span>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-gray-600 block">Total</span>
                            <span class="text-base font-bold text-blue-600">PHP {{ number_format($booking->total_price, 2) }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    @if($booking->status == 'pending')
                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('admin.bookings.approve', $booking->id) }}" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full py-2 px-3 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                    Approve
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.bookings.reject', $booking->id) }}" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full py-2 px-3 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                    Reject
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-center py-2 text-sm text-gray-400 bg-gray-50 rounded">
                            No actions available
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-8 text-center text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="mt-2">No bookings found</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Optional: Pagination -->
    @if(method_exists($bookings, 'links'))
        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    @endif
</div>

@endsection

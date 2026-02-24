<div>
    <!-- Filters - Responsive -->
    <div
        class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0 mb-4 sm:mb-6">
        <h2 class="text-lg sm:text-xl font-semibold text-gray-900">Booking Requests</h2>

    </div>

    <!-- Bookings List -->
    <div class="space-y-3 sm:space-y-4" id="bookings-list">
        <!-- Pending Booking -->
        @foreach ($bookings as $booking)
            <div
                class="booking-item pending bg-white rounded-lg sm:rounded-xl p-4 sm:p-6 border border-gray-100 hover:shadow-md transition-shadow duration-200">
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
                    <div class="flex items-start space-x-3 sm:space-x-4 w-full sm:w-auto">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg sm:rounded-xl flex items-center justify-center text-white font-bold text-sm sm:text-base flex-shrink-0">

                        </div>
                        <div class="flex-1">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-3">
                                <h3 class="font-semibold text-gray-900">{{ $booking->car->model }}</h3>
                                <span class="text-xs sm:text-sm text-gray-500">From {{ $booking->start_date }} to
                                    {{ $booking->end_date }}</span>
                            </div>
                            <div class="flex flex-wrap items-center gap-2 mt-1">

                                <span
                                    class="px-2 py-1 {{ $booking->status === 'approved'
                                        ? 'bg-green-100 text-green-800'
                                        : ($booking->status === 'cancelled'
                                            ? 'bg-red-100 text-red-800'
                                            : 'bg-yellow-100 text-yellow-800') }} text-xs font-medium rounded-full">{{ $booking->status }}</span>
                                <span class="text-xs sm:text-sm text-gray-500">Total days:
                                    {{ $booking->total_days }}</span>
                                <span class="text-xs sm:text-sm text-gray-500">• Total price:
                                    {{ $booking->total_price }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto justify-end">
                        
                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @if ($booking->status === 'pending')
                                <button
                                    class="flex-1 sm:flex-none px-3 sm:px-4 py-1.5 sm:py-2 bg-red-600 text-white text-xs sm:text-sm rounded-lg hover:bg-red-700 transition-colors duration-200 cursor-pointer">
                                    Decline
                                </button>
                            @else
                                <button disabled
                                    class="flex-1 sm:flex-none px-3 sm:px-4 py-1.5 sm:py-2 bg-gray-300 text-gray-500 text-xs sm:text-sm rounded-lg cursor-not-allowed">
                                    Decline
                                </button>
                            @endif
                        </form>
                    </div>
                </div>

            </div>
        @endforeach

    </div>

</div>

<!-- Booking Modal (Hidden by default) -->
<div id="bookingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-4 sm:p-5 border w-11/12 sm:w-96 shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg sm:text-xl font-semibold text-gray-900">New Booking</h3>
            <button onclick="hideBookingModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <form onsubmit="event.preventDefault(); createBooking();">
            <div class="space-y-3 sm:space-y-4">
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Service</label>
                    <select id="booking-service"
                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                        <option>Home Cleaning</option>
                        <option>Plumbing</option>
                        <option>Electrical</option>
                        <option>Gardening</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" id="booking-date"
                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                </div>
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Time</label>
                    <input type="time" id="booking-time"
                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                </div>
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" id="booking-location" placeholder="Enter address"
                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                </div>
            </div>
            <div class="flex space-x-3 mt-4 sm:mt-6">
                <button type="submit"
                    class="flex-1 px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                    Create Booking
                </button>
                <button type="button" onclick="hideBookingModal()"
                    class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    function filterBookings() {
        const filter = document.getElementById('booking-filter').value;
        const bookings = document.querySelectorAll('.booking-item');

        bookings.forEach(booking => {
            if (filter === 'all' || booking.classList.contains(filter)) {
                booking.style.display = 'block';
            } else {
                booking.style.display = 'none';
            }
        });
    }

    function showBookingModal() {
        document.getElementById('bookingModal').classList.remove('hidden');
    }

    function hideBookingModal() {
        document.getElementById('bookingModal').classList.add('hidden');
    }

    function createBooking() {
        const bookingData = {
            service: document.getElementById('booking-service').value,
            date: document.getElementById('booking-date').value,
            time: document.getElementById('booking-time').value,
            location: document.getElementById('booking-location').value
        };

        alert('Booking created successfully! (Demo)');
        console.log('New booking:', bookingData);
        hideBookingModal();
    }

    function acceptBooking(bookingId) {
        if (confirm(`Accept booking ${bookingId}?`)) {
            alert(`Booking ${bookingId} accepted!`);
        }
    }

    function declineBooking(bookingId) {
        if (confirm(`Decline booking ${bookingId}?`)) {
            alert(`Booking ${bookingId} declined!`);
        }
    }

    function viewBookingDetails(bookingId) {
        alert(`Viewing details for ${bookingId}`);
    }

    function rescheduleBooking(bookingId) {
        alert(`Reschedule booking ${bookingId}`);
    }

    function cancelBooking(bookingId) {
        if (confirm(`Cancel booking ${bookingId}?`)) {
            alert(`Booking ${bookingId} cancelled!`);
        }
    }

    function reviewBooking(bookingId) {
        alert(`Write review for ${bookingId}`);
        // Switch to reviews tab
        switchTab('reviews');
    }

    function rebookBooking(bookingId) {
        alert(`Rebooking ${bookingId}`);
        showBookingModal();
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('bookingModal');
        if (event.target === modal) {
            hideBookingModal();
        }
    }
</script>

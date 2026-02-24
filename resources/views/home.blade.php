@extends('layouts.app')

@section('content')

<!-- Hero Section - SLATE GRAY GRADIENT -->
@include('mainlayouts.hero')

<!-- Featured Cars Section - DYNAMIC FROM DATABASE -->
<section id="cars" class="py-24 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="text-slate-700 font-semibold mb-4 uppercase tracking-wider"></p>
            <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6">
                Choose Your Perfect Car
            </h2>
            <p class="text-gray-600">{{ $cars->count() }} vehicles available for rent</p>
        </div>
        
        <!-- Cars Grid - DYNAMIC FROM DATABASE -->
        
        
        <!-- View All Button -->
        <div class="text-center mt-12">
            <a href="{{ url('/car-listing') }}" class="border-2 border-slate-700 text-slate-700 hover:bg-slate-700 hover:text-white px-8 py-4 rounded-full font-semibold transition-all duration-300 inline-flex items-center gap-2">
                View All Cars
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- JavaScript for Booking -->
{{-- <script>
function bookCar(carId) {
    // Redirect to booking page with car ID
    window.location.href = '/booking/' + carId;
    
    // Or show a modal, AJAX request, etc.
    console.log('Booking car ID:', carId);
    alert('Booking ' + carId + ' - Booking functionality coming soon!');
}
</script> --}}

@endsection
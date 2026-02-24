@extends('admin.layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-8">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Total Bookings -->
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-500">Total Bookings</h3>
        <p class="text-3xl font-bold">{{ $totalBookings }}</p>
    </div>

    <!-- Users -->
    <div class="bg-blue-100 p-6 rounded shadow">
        <h3 class="text-blue-700">Total Users</h3>
        <p class="text-3xl font-bold text-blue-800">{{ $totalUsers }}</p>
    </div>

    <!-- Cars -->
    <div class="bg-purple-100 p-6 rounded shadow">
        <h3 class="text-purple-700">Total Cars</h3>
        <p class="text-3xl font-bold text-purple-800">{{ $totalCars }}</p>
    </div>
    
    <!-- Pending -->
    <div class="bg-yellow-100 p-6 rounded shadow">
        <h3 class="text-yellow-700">Pending Bookings</h3>
        <p class="text-3xl font-bold text-yellow-800">{{ $pendingBookings }}</p>
    </div>

    <!-- Approved -->
    <div class="bg-green-100 p-6 rounded shadow">
        <h3 class="text-green-700">Approved Bookings</h3>
        <p class="text-3xl font-bold text-green-800">{{ $approvedBookings }}</p>
    </div>

    <!-- Rejected -->
    <div class="bg-red-100 p-6 rounded shadow">
        <h3 class="text-red-700">Rejected Bookings</h3>
        <p class="text-3xl font-bold text-red-800">{{ $rejectedBookings }}</p>
    </div>

    

    

</div>

@endsection

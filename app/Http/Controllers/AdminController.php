<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.layouts.dashboard', [
            'totalBookings' => Booking::count(),
            'pendingBookings' => Booking::where('status', 'pending')->count(),
            'approvedBookings' => Booking::where('status', 'approved')->count(),
            'rejectedBookings' => Booking::where('status', 'cancelled')->count(),
            'totalUsers' => User::count(),
            'totalCars' => Car::count(),
        ]);
    }
}

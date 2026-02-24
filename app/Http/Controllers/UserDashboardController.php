<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        
        $bookings = Auth::user()
            ->bookings()
            ->with('car')
            ->latest()
            ->get();
        $pendingCount = $bookings->where('status', 'pending')->count();
        return view('users.dashboard', compact('bookings', 'pendingCount'));
    }
    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be cancelled.');
        }

        $booking->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Booking cancelled successfully.');
    }

}

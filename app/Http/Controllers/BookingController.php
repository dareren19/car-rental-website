<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Show booking form for a specific car
     */
    public function create(Car $car)
    {
        // Check if car is available
        if ($car->status !== 'available') {
            return redirect()->route('cars.show', $car)
                ->with('error', 'This car is not available for booking.');
        }

        return view('bookings.create', compact('car'));
    }

    /**
     * Store a new booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string|max:500'
        ]);

        $car = Car::findOrFail($request->car_id);

        // Calculate total days
        $start_date = \Carbon\Carbon::parse($request->start_date);
        $end_date = \Carbon\Carbon::parse($request->end_date);
        $total_days = $start_date->diffInDays($end_date) + 1; // +1 to include both start and end days

        $conflict = Booking::where('car_id', $car->id)
            ->where('status', 'approved') // only check approved bookings
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date])
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->where('start_date', '<=', $start_date)
                            ->where('end_date', '>=', $end_date);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->with('error', 'This car is already booked for the selected dates.');
        }
        $userConflict = Booking::where('user_id', Auth::id())
            ->where('car_id', $car->id)
            ->where('status', 'pending')
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', values: [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date])
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->where('start_date', '<=', $start_date)
                            ->where('end_date', '>=', $end_date);
                    });
            })
            ->exists();

        if ($userConflict) {
            return back()->with('error', 'You already have a pending booking for this car in these dates.');
        }

        $total_price = $total_days * $car->price_per_day;
        Booking::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'total_days' => $total_days,
            'total_price' => $total_price,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => 'pending'
        ]);
        return back()->with('success', 'Booking request sent successfully.');

        // Check if car is available for the selected dates
        // $isAvailable = Booking::where('car_id', $car->id)
        //     ->where(function ($query) use ($request) {
        //         $query->whereBetween('start_date', [$request->start_date, $request->end_date])
        //             ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
        //             ->orWhere(function ($q) use ($request) {
        //                 $q->where('start_date', '<=', $request->start_date)
        //                     ->where('end_date', '>=', $request->end_date);
        //             });
        //     })
        //     ->whereIn('status', ['pending', 'approved']) // Only check active bookings
        //     ->doesntExist();

        // if (!$isAvailable) {
        //     return back()->with('error', 'This car is not available for the selected dates.')
        //         ->withInput();
        // }

        // // Calculate total price
        // $total_price = $total_days * $car->price_per_day;

        // // Create booking
        // $booking = Booking::create([
        //     'user_id' => auth()->id() ?? null,
        //     'car_id' => $car->id,
        //     'start_date' => $request->start_date,
        //     'end_date' => $request->end_date,
        //     'total_days' => $total_days,
        //     'total_price' => $total_price,
        //     'notes' => $request->notes,
        //     'status' => 'pending'
        // ]);

        // // Update car status
        // $car->update(['status' => 'booked']);

        // return redirect()->route('booking.show', $booking)
        //     ->with('success', 'Booking request submitted successfully! Waiting for admin approval.');
    }

    /**
     * Display booking details
     */
    // public function show(Booking $booking)
    // {
    //     // Check if user owns this booking or is admin
    //     if (auth()->id() !== $booking->user_id && !auth()->user()->isAdmin()) {
    //         abort(403, 'Unauthorized access.');
    //     }

    //     return view('bookings.show', compact('booking'));
    // }
    public function show(Booking $booking)
    {
        $user = auth()->user();

        // Abort if user is not owner and not admin
        if (!$user || ($user->id !== $booking->user_id && !$user->isAdmin())) {
            abort(403, 'Unauthorized access.');
        }

        return view('bookings.show', compact('booking'));
    }

    /**
     * List user's bookings
     */
    public function index()
    {
        $bookings = Auth::user()->bookings()
            ->with('car')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Cancel booking (user action)
     */
    public function cancel(Booking $booking)
    {
        // Check if user owns this booking
        if (auth()->id() !== $booking->user_id) {
            abort(403);
        }

        // Only allow cancellation of pending or approved bookings
        if (in_array($booking->status, ['pending', 'approved'])) {
            $booking->update(['status' => 'cancelled']);

            // Make car available again if booking was approved
            if ($booking->status === 'approved') {
                $booking->car->update(['status' => 'available']);
            } elseif ($booking->status === 'pending') {
                $booking->car->update(['status' => 'available']);
            }

            return back()->with('success', 'Booking cancelled successfully.');
        }

        return back()->with('error', 'This booking cannot be cancelled.');
    }
}
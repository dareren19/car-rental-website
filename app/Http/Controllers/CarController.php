<?php

namespace App\Http\Controllers;

use App\Models\Car;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $featuredCar = Car::where('is_featured', true)
            ->inRandomOrder()
            ->first();

        // Get all available cars for the fleet section
        $cars = Car::where('is_available', true)
            // ->orderBy('is_featured', 'desc')
            ->inRandomOrder()
            
            ->get();
        return view('home', compact('featuredCar', 'cars'));
    }

    public function listing(Request $request)
    {
        $query = Car::where('is_available', true);

        if ($request->filled('car_type')) {
            $query->where('car_type', $request->car_type);
        }
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }
        if ($request->filled('rfid_type')) {
            $query->where('rfid_type', $request->rfid_type);
        }
        $cars = $query->latest()->paginate(6);
        // $brands = Car::distinct()->whereNotNull('brand')->pluck('brand');
        $car_types = Car::distinct()->whereNotNull('car_type')->pluck('car_type');
        $transmissions = Car::distinct()->whereNotNull('transmission')->pluck('transmission');
        $rfid_types = Car::distinct()->whereNotNull('rfid_type')->pluck('rfid_type');

        return view('cars.car-listing', [
            'cars' => $cars,

            'car_types' => $car_types,
            'transmissions' => $transmissions,
            'rfid_types' => $rfid_types,
            'filters' => $request->only(['transmission', 'car_type', 'rfid_type', 'search']),
        ]);
    }
    public function show($id)
    {
        $car = Car::with('images')->findOrFail($id);

        // Simple similar cars (same brand)
        $similarCars = Car::where('is_available', true)
            ->where('id', '!=', $id)
            ->where('brand', $car->brand)
            ->limit(4)
            ->get();

        return view('cars.car-detail', compact('car', 'similarCars'));
    }
}






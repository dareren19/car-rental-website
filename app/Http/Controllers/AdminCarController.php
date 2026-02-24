<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%");
            });
        }

        // Transmission filter
        if ($request->has('transmission') && !empty($request->transmission)) {
            $query->where('transmission', $request->transmission);
        }

        // Fuel type filter
        if ($request->has('fuel_type') && !empty($request->fuel_type)) {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Get cars with pagination
        $cars = $query->latest()->paginate(10);

        // Calculate stats
        $availableCount = Car::where('is_available', true)->count();
        $featuredCount = Car::where('is_featured', true)->count();
        $avgPrice = Car::avg('price_per_day');

        return view('admin.cars.index', compact('cars', 'availableCount', 'featuredCount', 'avgPrice'));
    }
    public function create()
    {
        return view('admin.cars.create-car');
    }

    public function store(Request $request)
    {
        // Validate car details
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'transmission' => 'required|in:Automatic,Manual',
            'fuel_type' => 'required|in:Gasoline,Diesel',
            'seats' => 'required|integer|min:2|max:9',
            'price_per_day' => 'required|numeric|min:0',
            'rfid_type' => 'nullable|string|max:50',
            'is_available' => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean',
            'description' => 'nullable|string',
            'images' => 'required|array|min:1', // At least 1 image required
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max per image
        ]);

        // Handle boolean fields
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');

        // Create the car
        $car = Car::create($validated);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $sortOrder = 0;

            foreach ($request->file('images') as $index => $image) {
                // Store image
                $path = $image->store('cars/' . $car->id, 'public');

                // Create image record
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                    'is_primary' => $index === 0, // First image is primary
                    'sort_order' => $sortOrder++,
                ]);
            }
        }

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car added successfully with images!');
    }
    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified car.
     */
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified car in storage.
     */
    public function update(Request $request, Car $car)
{
    // Validate the request
    $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'year' => 'required|integer|min:2000|max:' . date('Y'),
        'transmission' => 'required|in:Automatic,Manual',
        'fuel_type' => 'required|in:Gasoline,Diesel',
        'seats' => 'required|integer|min:2|max:16',
        'price_per_day' => 'required|numeric|min:0',
        'rfid_type' => 'nullable|string|max:50',
        'is_available' => 'sometimes|boolean',
        'is_featured' => 'sometimes|boolean',
        'description' => 'nullable|string',
        'new_images' => 'nullable|array',
        'new_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
    ]);

    // Handle boolean fields
    $validated['is_available'] = $request->has('is_available');
    $validated['is_featured'] = $request->has('is_featured');

    // Update car details
    $car->update($validated);

    // Handle NEW image uploads
    if ($request->hasFile('new_images')) {
        foreach ($request->file('new_images') as $image) {
            $path = $image->store('cars/' . $car->id, 'public');
            
            $car->images()->create([
                'image_path' => $path,
                'is_primary' => false,
                'sort_order' => $car->images()->max('sort_order') + 1,
            ]);
        }
    }

    // Handle primary image change
    if ($request->filled('primary_image_id')) {
        // Reset all images to non-primary
        $car->images()->update(['is_primary' => false]);
        
        // Set the selected image as primary
        $car->images()->where('id', $request->primary_image_id)->update(['is_primary' => true]);
    }

    // Handle image deletions - FIXED VERSION
    if ($request->filled('delete_images')) {
        // Convert comma-separated string to array
        $deleteIds = explode(',', $request->delete_images);
        
        // Filter out empty values
        $deleteIds = array_filter($deleteIds);
        
        if (!empty($deleteIds)) {
            // Get images to delete files from storage
            $imagesToDelete = CarImage::whereIn('id', $deleteIds)->get();
            
            foreach ($imagesToDelete as $image) {
                // Delete file from storage
                Storage::disk('public')->delete($image->image_path);
            }
            
            // Delete from database
            CarImage::whereIn('id', $deleteIds)->delete();
        }
    }

    return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully!');
}
     public function destroy(Car $car)
    {
        // Delete the car (images will be auto-deleted via boot method in CarImage model)
        $car->delete();

        // Delete the car directory
        Storage::disk('public')->deleteDirectory('cars/' . $car->id);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car deleted successfully!');
    }
    public function reorderImages(Request $request, Car $car)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|exists:car_images,id',
            'images.*.sort_order' => 'required|integer',
        ]);

        foreach ($request->images as $imageData) {
            CarImage::where('id', $imageData['id'])
                ->where('car_id', $car->id)
                ->update(['sort_order' => $imageData['sort_order']]);
        }

        return response()->json(['success' => true]);
    }
}

<?php

use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminCarController;
use App\Http\Controllers\AdminController;


use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;


use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;


// Home
Route::get('/', [CarController::class, 'index'])->name('car.index');
// users only routes
Route::middleware(['auth', 'redirect.if.admin'])->group(function () {
    
    Route::get('/car-listing', [CarController::class, 'listing'])->name('car.listing');
    Route::get('/car-detail/${id}', [CarController::class, 'show'])->name('car.show');
    Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/bookings/${id}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/dashboard',[UserDashboardController::class, 'index'])->name('dashboard');
    Route::patch('/booking/{id}/cancel', [UserDashboardController::class, 'cancel'])->name('booking.cancel');
});

// Admin only routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.layouts.dashboard');

    Route::get('/bookings', [AdminBookingController::class, 'index'])
        ->name('admin.bookings.index');

    Route::patch('/bookings/{id}/approve', [AdminBookingController::class, 'approve'])
        ->name('admin.bookings.approve');

    Route::patch('/bookings/{id}/reject', [AdminBookingController::class, 'reject'])
        ->name('admin.bookings.reject');  

    Route::get('/cars', [AdminCarController::class, 'index'])->name('admin.cars.index');    
    Route::get('/cars/create', [AdminCarController::class, 'create'])->name('admin.cars.create-car');

    Route::post('/cars', [AdminCarController::class, 'store'])->name('admin.cars.store');  
    Route::get('/cars/{car}', [AdminCarController::class, 'show'])->name('admin.cars.show');
    Route::get('/cars/{car}/edit', [AdminCarController::class, 'edit'])->name('admin.cars.edit');
    Route::patch('/cars/{car}', [AdminCarController::class, 'update'])->name('admin.cars.update');
    Route::delete('/cars/{car}', [AdminCarController::class, 'destroy'])->name('admin.cars.destroy');  

    // Route::get('/cars', [AdminCarController::class, 'index'])
    //     ->name('admin.cars');

    // Route::get('/users', [AdminUserController::class, 'index'])
    //     ->name('admin.users');

});
Route::fallback(function() {
    return response()->view('404page', [], 404);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

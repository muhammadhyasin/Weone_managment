<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');})->middleware(['auth', 'admin'])->name('dashboard');
    
Route::get('/office', function () {
    return view('office.dashboard');})->middleware(['auth', 'verified'])->name('office-dashboard');

Route::get('/driver', function () {
    return view('driver.dashboard');})->middleware(['auth', 'verified'])->name('driver-dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/create', function () {
    return view('forms.create-order');})->middleware(['auth', 'verified'])->name('create');
    
Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index'); // List all orders
    Route::get('/create', [OrderController::class, 'create'])->name('orders.create'); // Show form to create a new order
    Route::post('/', [OrderController::class, 'store'])->name('orders.store'); // Store a new order
    Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit'); // Show form to edit an existing order
    Route::put('/{order}', [OrderController::class, 'update'])->name('orders.update'); // Update an existing order
    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('orders.destroy'); // Delete an order (optional)
});

require __DIR__.'/auth.php';


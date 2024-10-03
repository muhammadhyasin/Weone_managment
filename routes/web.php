<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('admin.dashboard');})->middleware(['auth', 'admin'])->name('dashboard');
Route::get('/', [OrderController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');
Route::get('/order/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/order/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{order}/refund', [OrderController::class, 'refund'])->name('orders.refund');
Route::get('/index', [OrderController::class, 'singleindex'])->name('orders.index');
Route::get('/index-pending', [OrderController::class, 'pendingindex'])->name('orders.pending');
Route::get('/index-completed', [OrderController::class, 'completedindex'])->name('orders.completed');
Route::get('/index-refunded', [OrderController::class, 'refundindex'])->name('orders.refunded');
Route::get('/invoice/{order}', [OrderController::class, 'invoice'])->name('invoice.show');

    
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
    

Route::get('/order-create', [OrderController::class, 'create'])->name('orders.create'); // Show form to create a new order
Route::post('/order-store', [OrderController::class, 'store'])->name('orders.store'); // Store a new order
Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit'); // Show form to edit an existing order
Route::put('/{order}', [OrderController::class, 'update'])->name('orders.update'); // Update an existing order
Route::delete('/{order}', [OrderController::class, 'destroy'])->name('orders.destroy'); // Delete an order (optional)


require __DIR__.'/auth.php';


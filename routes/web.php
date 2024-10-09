<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//orders 
Route::get('/', [OrderController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');
Route::get('/order/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::put('/orders/{order}/refund', [OrderController::class, 'refund'])->name('orders.refund')->middleware(['auth', 'admin']);
Route::get('/index', [OrderController::class, 'singleindex'])->name('orders.index');
Route::get('/index-pending', [OrderController::class, 'pendingindex'])->name('orders.pending');
Route::get('/index-completed', [OrderController::class, 'completedindex'])->name('orders.completed');
Route::get('/index-refunded', [OrderController::class, 'refundindex'])->name('orders.refunded');
Route::get('/invoice/{order}', [OrderController::class, 'invoice'])->name('invoice.show');
Route::get('/order-create', [OrderController::class, 'create'])->name('orders.create'); 
Route::post('/order-store', [OrderController::class, 'store'])->name('orders.store'); 
Route::put('/{order}', [OrderController::class, 'update'])->name('orders.update'); 
Route::get('/create', [OrderController::class, 'createview'])->name('create'); 


//expenses
Route::get('/expenses', [ExpenseController::class, 'create'])->name('expense.create');
Route::post('/expenses-save', [ExpenseController::class, 'store'])->name('expense.store');
    

//office
Route::get('/office', function () {
    return view('office.dashboard');})->middleware(['auth', 'verified'])->name('office-dashboard');



//driver
Route::get('/driver', function () {
    return view('driver.dashboard');})->middleware(['auth', 'verified'])->name('driver-dashboard');



Route::get('/user', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/registeradd', [RegisteredUserController::class, 'storeadd'])->name('users.add');

// web.php
Route::get('/users/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::patch('/user/{id}', [UserController::class, 'update'])->name('user.update'); // For updating user details


require __DIR__.'/auth.php';


<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EC2Controller;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSalaryController;
use App\Models\Order;
use App\Http\Controllers\PickupController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//orders 
Route::middleware(['auth', 'checkStatus'])->group(function () {
    Route::get('/', [OrderController::class, 'index'])->middleware(['verified'])->name('admin.dashboard');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/index', [OrderController::class, 'singleindex'])->name('orders.index');
    Route::get('/index-pending', [OrderController::class, 'pendingindex'])->name('orders.pending');
    Route::get('/index-completed', [OrderController::class, 'completedindex'])->name('orders.completed');
    Route::get('/index-refunded', [OrderController::class, 'refundindex'])->name('orders.refunded');
    Route::get('/invoice/{order}', [OrderController::class, 'invoice'])->name('invoice.show');
    Route::get('/order-create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/order-store', [OrderController::class, 'store'])->name('orders.store');
    Route::put('/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/create', [OrderController::class, 'createview'])->name('create');
});

Route::put('/orders/{order}/refund', [OrderController::class, 'refund'])->name('orders.refund')->middleware(['auth', 'admin']);


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
Route::patch('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::patch('/users-password/{id}', [UserController::class, 'updatePassword'])->name('user.password');

Route::get('/user/{userId}/salary', [UserSalaryController::class, 'edit'])->name('user.salary.edit');
Route::post('/user/{userId}/salary-update', [UserSalaryController::class, 'storeOrUpdate'])->name('user.salary.storeOrUpdate');



Route::get('/ec2', [EC2Controller::class, 'listInstances'])->name('ec2.list')->middleware(['auth', 'admin']);
Route::get('/ec2/start/{id}', [EC2Controller::class, 'startInstance'])->name('ec2.start')->middleware(['auth', 'admin']);
Route::get('/ec2/stop/{id}', [EC2Controller::class, 'stopInstance'])->name('ec2.stop')->middleware(['auth', 'admin']);
Route::get('/ec2/rdp/{id}', [EC2Controller::class, 'downloadRdp'])->name('ec2.downloadRdp')->middleware(['auth', 'admin']);
Route::get('/ec2/instances/status', [EC2Controller::class, 'getInstanceStatuses'])->name('ec2.status')->middleware(['auth', 'admin']);



Route::prefix('pickup')->group(function () {
    Route::get('/create', [PickupController::class, 'create'])->name('create.pickup'); // Form for creating pickups
    Route::post('/store', [PickupController::class, 'store'])->name('pickup.store'); // Store new pickups
    Route::get('/{id}', [PickupController::class, 'show'])->name('pickup.show'); // Show details of a single pickup
    Route::put('/{pickup}', [PickupController::class, 'update'])->name('pickups.update'); // Update pickup
    
});
Route::get('/pickup-view', [PickupController::class, 'singleindex'])->name('pickup.index'); // All pickups
Route::get('/pickup-pending', [PickupController::class, 'pendingindex'])->name('pickup.pending'); // Pending pickups
Route::get('/pickup-completed', [PickupController::class, 'completedindex'])->name('pickup.completed'); // Completed pickups


require __DIR__.'/auth.php';


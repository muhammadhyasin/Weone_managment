<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EC2Controller;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSalaryController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Routes that require 'auth' middleware
Route::middleware(['auth', 'checkStatus', 'activity'])->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Order routes
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
    Route::put('/orders/{order}/refund', [OrderController::class, 'refund'])->name('orders.refund')->middleware('admin');
    Route::put('/orders/{order}/update-payment-status', [OrderController::class, 'updatePaymentStatus'])->name('orders.updatePaymentStatus');

    // Expense routes
    Route::get('/expenses', [ExpenseController::class, 'create'])->name('expense.create');
    Route::post('/expenses-save', [ExpenseController::class, 'store'])->name('expense.store');
    Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy'])->name('expense.destroy');


    // Office and driver dashboards
    Route::get('/office', fn() => view('office.dashboard'))->middleware(['verified'])->name('office-dashboard');
    Route::get('/driver', fn() => view('driver.dashboard'))->middleware(['verified'])->name('driver-dashboard');

    // User management routes
    Route::middleware('admin')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/registeradd', [RegisteredUserController::class, 'storeadd'])->name('users.add');
        Route::get('/users/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::patch('/users-password/{id}', [UserController::class, 'updatePassword'])->name('user.password');
    });

    // User salary routes
    Route::middleware('admin')->group(function () {
        Route::get('/user/{userId}/salary', [UserSalaryController::class, 'edit'])->name('user.salary.edit');
        Route::post('/user/{userId}/salary-update', [UserSalaryController::class, 'storeOrUpdate'])->name('user.salary.storeOrUpdate');
    });

    // EC2 instance routes
    Route::middleware('admin')->group(function () {
        Route::get('/ec2', [EC2Controller::class, 'listInstances'])->name('ec2.list');
        Route::get('/ec2/start/{id}', [EC2Controller::class, 'startInstance'])->name('ec2.start');
        Route::get('/ec2/stop/{id}', [EC2Controller::class, 'stopInstance'])->name('ec2.stop');
        Route::get('/ec2/rdp/{id}', [EC2Controller::class, 'downloadRdp'])->name('ec2.downloadRdp');
        Route::get('/ec2/instances/status', [EC2Controller::class, 'getInstanceStatuses'])->name('ec2.status');
    });

    // Pickup routes
    Route::prefix('pickup')->group(function () {
        Route::get('/create', [PickupController::class, 'create'])->name('create.pickup');
        Route::post('/store', [PickupController::class, 'store'])->name('pickup.store');
        Route::get('/{id}', [PickupController::class, 'show'])->name('pickup.show');
        Route::put('/{pickup}', [PickupController::class, 'update'])->name('pickups.update');
        Route::put('/{pickup}/update-pickup-status', [PickupController::class, 'updatePickupStatus'])->name('pickups.updatePickupStatus');
    });

    Route::get('/pickup-view', [PickupController::class, 'singleindex'])->name('pickup.index');
    Route::get('/pickup-pending', [PickupController::class, 'pendingindex'])->name('pickup.pending');
    Route::get('/pickup-completed', [PickupController::class, 'completedindex'])->name('pickup.completed');

    // Log routes for superadmins
    Route::middleware('superadmin')->group(function () {
        Route::get('/logs', [SuperAdminController::class, 'logindex'])->name('superlogs.index');
        Route::post('/logs/clear', [SuperAdminController::class, 'clearLogs'])->name('logs.clear');
        Route::get('/logs/download/{file}', fn($file) => Storage::download($file))->name('logs.download');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts.index');
        Route::get('/shifts/create', [ShiftController::class, 'create'])->name('shifts.create');
        Route::post('/shifts/store', [ShiftController::class, 'store'])->name('shifts.store');
        Route::get('/shifts/{id}/edit', [ShiftController::class, 'edit'])->name('shifts.edit');
        Route::patch('/shifts/{shift}', [ShiftController::class, 'update'])->name('shifts.update');
        Route::delete('/shifts/{shift}', [ShiftController::class, 'destroy'])->name('shifts.destroy');
    });
});

Route::post('/update-last-seen', [UserController::class, 'updateLastSeen'])->name('user.updateLastSeen');
Route::fallback(function () {return view('error.index');});
Route::post('/profile/update-picture', [ProfileController::class, 'uploadProfilePicture'])->name('profile.upload');
Route::get('/profile-view/{id}', [UserController::class, 'profile'])->name('profile.new');


// Authentication routes
require __DIR__ . '/auth.php';

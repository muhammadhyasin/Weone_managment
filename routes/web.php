<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
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
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    
    
});


require __DIR__.'/auth.php';


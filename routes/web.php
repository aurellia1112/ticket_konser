<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrdersController;

// 1 Halman utama
Route::get('/', [OrdersController::class, 'index'])->name('customer.index');
Route::post('/checkout', [OrdersController::class, 'store'])->name('customer.checkout');

// 2 Dashboard admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [OrdersController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/admin/dashboard', [OrdersController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::patch('/admin/orders/{id}/status', [OrdersController::class, 'updateStatus'])->name('admin.orders.dashboard');
    Route::resource('/admin/events', EventsController::class);
});

// 3 Grup rute profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

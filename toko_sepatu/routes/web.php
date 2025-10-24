<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HandphoneController;

Route::get('/', function () {
    return view('pages.dashboard.index');
});

// ===== ROUTE UNTUK USER =====
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');    
Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');

// ===== ROUTE UNTUK HANDPHONE =====
Route::get('/handphone', [HandphoneController::class, 'index'])->name('handphone.index');
Route::get('/handphone/create', [HandphoneController::class, 'create'])->name('handphone.create');
Route::post('/handphone/store', [HandphoneController::class, 'store'])->name('handphone.store');
Route::get('/handphones/{id}', [HandphoneController::class, 'show'])->name('handphones.show');

// ===== ROUTE UNTUK SERVICE =====
Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');
Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service.show');

// ===== ROUTE UNTUK SALES =====
Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
Route::get('/sales/create', [SalesController::class, 'create'])->name('sales.create');
Route::post('/sales/store', [SalesController::class, 'store'])->name('sales.store');
Route::get('/sales/{id}', [SalesController::class, 'show'])->name('sales.show');

// Route untuk Payment
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
Route::get('/payment/{id}/edit', [PaymentController::class, 'edit'])->name('payment.edit');
Route::post('/payment/{id}/update', [PaymentController::class, 'update'])->name('payment.update');
Route::delete('/payment/{id}/delete', [PaymentController::class, 'destroy'])->name('payment.destroy');
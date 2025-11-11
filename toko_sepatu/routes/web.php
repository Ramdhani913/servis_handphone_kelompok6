<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HandphoneController;
use App\Http\Controllers\ServiceitemController;

/*
|--------------------------------------------------------------------------
| Public Routes (tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/form', [AuthController::class, 'showLoginForm'])->name('login'); // 🟩 penting: nama 'login' agar auth middleware tahu
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (wajib login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // 🏠 Dashboard
    Route::get('/', function () {
        return view('pages.dashboard.index');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');

    /*
    |--------------------------------------------------------------------------
    | Service Item Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/serviceitems', [ServiceitemController::class, 'index'])->name('serviceitems.index');
    Route::get('/serviceitems/create', [ServiceitemController::class, 'create'])->name('serviceitems.create');
    Route::post('/serviceitems/store', [ServiceitemController::class, 'store'])->name('serviceitems.store');
    Route::get('/serviceitems/{id}/edit', [ServiceitemController::class, 'edit'])->name('serviceitems.edit');
    Route::post('/serviceitems/{id}/update', [ServiceitemController::class, 'update'])->name('serviceitems.update');
    Route::delete('/serviceitems/{id}/delete', [ServiceitemController::class, 'destroy'])->name('serviceitems.destroy');
    Route::post('/serviceitems/{id}/toggle-status', [ServiceitemController::class, 'toggleStatus'])->name('serviceitems.toggle');

    /*
    |--------------------------------------------------------------------------
    | Handphone Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/handphones', [HandphoneController::class, 'index'])->name('handphones.index');
    Route::get('/handphones/create', [HandphoneController::class, 'create'])->name('handphones.create');
    Route::post('/handphones/store', [HandphoneController::class, 'store'])->name('handphones.store');
    Route::get('/handphones/{id}/edit', [HandphoneController::class, 'edit'])->name('handphones.edit');
    Route::post('/handphones/{id}/update', [HandphoneController::class, 'update'])->name('handphones.update');
    Route::get('/handphones/{id}', [HandphoneController::class, 'show'])->name('handphones.show');
    Route::delete('/handphones/{id}/delete', [HandphoneController::class, 'destroy'])->name('handphones.destroy');
    Route::post('/handphones/{id}/toggle-status', [HandphoneController::class, 'toggleStatus'])->name('handphones.toggleStatus');
    Route::post('/handphones/check-duplicate', [HandphoneController::class, 'checkDuplicate'])->name('handphones.checkDuplicate');

    /*
    |--------------------------------------------------------------------------
    | Service Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/create', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/{id}', [ServiceController::class, 'detail'])->name('services.show');
        Route::delete('/{id}/delete', [ServiceController::class, 'destroy'])->name('services.destroy');
    });
    Route::patch('services/{id}/status', [ServiceController::class, 'updateStatus'])->name('services.updateStatus');
    Route::post('/services/update-cost/{id}', [ServiceController::class, 'updateCost'])->name('services.updateCost');
    Route::post('/services/pay/{id}', [ServiceController::class, 'processPayment'])->name('services.processPayment');
    Route::get('/services/{id}/payment', [ServiceController::class, 'payment'])->name('services.paymentView');
});

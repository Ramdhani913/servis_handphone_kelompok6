<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HandphoneController;
use App\Http\Controllers\ServiceitemController;

route::get('/', function () {
    return view('pages.dashboard.index');
});


// User Routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');    
Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');
// Serviceitem Routes
Route::get('/serviceitems', [ServiceitemController::class, 'index'])->name('serviceitems.index');
Route::get('/serviceitems/create', [ServiceitemController::class, 'create'])->name('serviceitems.create');
Route::post('/serviceitems/store', [ServiceitemController::class, 'store'])->name('serviceitems.store');
Route::get('/serviceitems/{id}', [ServiceitemController::class, 'show'])->name('serviceitems.show');
Route::get('/serviceitems/{id}/edit', [ServiceitemController::class, 'edit'])->name('serviceitems.edit');    
Route::post('/serviceitems/{id}/update', [ServiceitemController::class, 'update'])->name('serviceitems.update');
Route::delete('/serviceitems/{id}/delete', [ServiceitemController::class, 'destroy'])->name('serviceitems.destroy');
// Handphone Routes
Route::get('/handphones/create', [HandphoneController::class, 'create'])->name('handphones.create');
Route::post('/handphones/store', [HandphoneController::class, 'store'])->name('handphones.store'); 
Route::get('/handphones/{id}/edit', [HandphoneController::class, 'edit'])->name('handphones.edit');    
Route::post('/handphones/{id}/update', [HandphoneController::class, 'update'])->name('handphones.update');
Route::get('/handphones/{id}', [HandphoneController::class, 'show'])->name('handphones.show');
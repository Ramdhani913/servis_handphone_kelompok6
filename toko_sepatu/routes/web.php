<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

route::get('/', function () {
    return view('pages.dashboard.index');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.dashboard.index');
});

Route::get('/user', function () {
    return view('pages.maindata.user.index');
});

Route::get('/user/create', function () {
    return view('pages.maindata.user.create');
});

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

/// ========= template
Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::get('home', function () {
    return view('home.index');
})->name('home');

Route::get('period', function () {
    return view('period.index');
})->name('period');
Route::get('period.info', function () {
    return view('period.info');
})->name('period.info');

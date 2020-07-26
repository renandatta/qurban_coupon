<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

// ========= auth
Route::get('login', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@login_process')->name('login.process');
Route::get('logout', 'AuthController@logout')->name('logout');

// ========= home
Route::get('home', 'HomeController@index')->name('home');

// ========= period
Route::get('period', 'PeriodController@index')->name('period');
Route::post('period/search', 'PeriodController@search')->name('period.search');
Route::get('period/info', 'PeriodController@info')->name('period.info');
Route::post('period/save', 'PeriodController@save')->name('period.save');
Route::post('period/delete', 'PeriodController@delete')->name('period.delete');

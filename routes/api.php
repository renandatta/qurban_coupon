<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'ApiController@login');
Route::post('auth/logout', 'ApiController@logout');

Route::post('period/search', 'ApiController@period_search');
Route::post('coupon/claim', 'ApiController@claim');

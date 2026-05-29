<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/matches', function () {
    return view('frontend.matches');
});

Route::get('/tickets', function () {
    return view('frontend.tickets');
});
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
});Route::get('/reserve', fn() => view('frontend.reserve'))->name('reserve');
Route::post('/reserve/submit', [App\Http\Controllers\ReservationController::class, 'store'])->name('reserve.store');
use App\Http\Controllers\ReservationController;
Route::get('/reserve', [ReservationController::class, 'index'])->name('reserve');
Route::post('/reserve/submit', [ReservationController::class, 'store'])->name('reserve.store');
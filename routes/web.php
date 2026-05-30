<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;

// ── FRONTEND ──────────────────────────────────────
Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/matches', function () {
    return view('frontend.matches');
});

Route::get('/tickets', function () {
    return view('frontend.tickets');
});

Route::get('/venue', function () {
    return view('frontend.venue');
});

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/reserve', [ReservationController::class, 'index'])->name('reserve');
Route::post('/reserve/submit', [ReservationController::class, 'store'])->name('reserve.store');

// ── ADMIN LOGIN ───────────────────────────────────
Route::get('/admin/login',  [AdminLoginController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
Route::patch('/categories/{id}/soldout', [AdminController::class, 'toggleSoldOut'])->name('admin.categories.soldout');

// ── ADMIN DASHBOARD (protected) ───────────────────
Route::middleware(\App\Http\Middleware\AdminAuth::class)->prefix('admin')->group(function () {
    Route::get('/',           [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout',    [AdminController::class, 'logout'])->name('admin.logout');

    Route::get('/reservations/{id}',          [AdminController::class, 'showReservation']);
    Route::patch('/reservations/{id}/status', [AdminController::class, 'updateReservationStatus']);

    Route::get('/matches/{id}',  [AdminController::class, 'showMatch']);
    Route::post('/matches',      [AdminController::class, 'storeMatch']);
    Route::put('/matches/{id}',  [AdminController::class, 'updateMatch']);

    Route::post('/categories/prices',             [AdminController::class, 'updatePrices']);
    Route::patch('/categories/{id}/availability', [AdminController::class, 'toggleAvailability']);

    Route::get('/scan/{code}',        [AdminController::class, 'scan']);
    Route::post('/scan/{code}/enter', [AdminController::class, 'markEntered']);

    Route::get('/ads',               [AdminController::class, 'adsIndex'])->name('admin.ads');
    Route::post('/ads',              [AdminController::class, 'storeAd'])->name('admin.ads.store');
    Route::patch('/ads/{id}/toggle', [AdminController::class, 'toggleAd'])->name('admin.ads.toggle');
    Route::delete('/ads/{id}',       [AdminController::class, 'deleteAd'])->name('admin.ads.delete');
});
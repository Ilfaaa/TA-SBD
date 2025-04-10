<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ReservasiBooking; // Import komponen Livewire
use App\Http\Controllers\AuthController;
use App\Livewire\HistoryReservasi;
// Dashboard
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Reservasi Booking Livewire
Route::get('/reservasi', ReservasiBooking::class)->name('reservasi-booking');
Route::get('/history', HistoryReservasi::class)->name('history');

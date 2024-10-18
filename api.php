<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BuildingController;

Route::get('/bookings', [BookingController::class, 'getBookingsByDate'])->name('bookings.get');
Route::post('/booking/create', [BookingController::class, 'create'])->name('bookings.create');

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

Route::get('/buildings', [BuildingController::class, 'index'])->name('buildings.index');
Route::get('/buildings/{id}', [BuildingController::class, 'show_rooms'])->name('buildings.show_rooms');

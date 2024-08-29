<?php

use App\Http\Controllers\BillboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SeatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    // Rutas de Booking (Reservas)
    Route::post('/bookings/cancel', [BookingController::class, 'cancel']);
    Route::get('/bookings/terror', [BookingController::class, 'getTerrorBookings']);
    Route::get('/bookings/seats', [BookingController::class, 'getAvailableAndOccupiedSeats']);

    // Rutas de Billboard (Cartelera)
    Route::post('/billboards/cancel', [BillboardController::class, 'cancel']);


    ###################### SEATS #########################
    Route::get('seats', [SeatController::class, 'index']);
    Route::get('/seats/{seatentity}', [SeatController::class, 'show']);
    Route::post('/seats', [SeatController::class, 'store']);
    Route::put('/seats/{seatentity}', [SeatController::class, 'update']);
    Route::patch('/seats/{seatentity}', [SeatController::class, 'update']);
    Route::delete('/seats/{seatentity}', [SeatController::class, 'destroy']);


    ###################### billboard #########################
    Route::get('billboards', [BillboardController::class, 'index']);
    Route::get('/billboards/{billboard}', [BillboardController::class, 'show']);
    Route::post('/billboards', [BillboardController::class, 'store']);
    Route::put('/billboards/{billboard}', [BillboardController::class, 'update']);
    Route::patch('/billboards/{billboard}', [BillboardController::class, 'update']);
    Route::delete('/billboards/{billboard}', [BillboardController::class, 'destroy']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Reserva de assentos
|--------------------------------------------------------------------------
*/

Route::post('/reservar', [TicketController::class, 'reserve'])
    ->name('tickets.reserve');

/*
|--------------------------------------------------------------------------
| Lista de assentos
|--------------------------------------------------------------------------
*/

Route::get('/assentos', [TicketController::class, 'listSeats'])
    ->name('tickets.seats');

/*
|--------------------------------------------------------------------------
| Histórico de compras
|--------------------------------------------------------------------------
*/

Route::get('/compras', [TicketController::class, 'purchases'])
    ->name('tickets.purchases');

/*
|--------------------------------------------------------------------------
| Histórico DLQ
|--------------------------------------------------------------------------
*/

Route::get('/dlq', [TicketController::class, 'dlq'])
    ->name('tickets.dlq');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/seats', [TicketController::class, 'listSeats']);

Route::post('/reserve', [TicketController::class, 'reserve']);

Route::get('/purchases', [TicketController::class, 'purchases']);

Route::get('/dlq', [TicketController::class, 'dlq']);
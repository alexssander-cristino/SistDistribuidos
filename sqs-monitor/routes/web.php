<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| API (SQS + backend)
|--------------------------------------------------------------------------
*/
Route::post('/reservar', [TicketController::class, 'reserve'])->name('tickets.reserve');

/*
|--------------------------------------------------------------------------
| Páginas (FRONTEND)
|--------------------------------------------------------------------------
*/
Route::get('/assentos', [PageController::class, 'seats'])->name('page.seats');

Route::get('/compras', [PageController::class, 'purchases'])->name('page.purchases');

Route::get('/dlq', [PageController::class, 'dlq'])->name('page.dlq');

Route::get('/fila-sqs', [PageController::class, 'sqs'])->name('page.sqs');
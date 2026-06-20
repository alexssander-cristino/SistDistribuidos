<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Purchase;
use App\Models\DeadMessage;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 🪑 ASSENTOS (MongoDB)
        $seats = Seat::all();

        $totalSeats = $seats->count();
        $soldSeats = $seats->where('status', 'vendido')->count();
        $reservedSeats = $seats->where('status', 'reservado')->count();
        $freeSeats = $seats->where('status', 'livre')->count();

        // 💰 COMPRAS (MongoDB)
        $purchases = Purchase::count();

        // 💀 DLQ (MongoDB)
        $deadMessages = DeadMessage::count();

        // 📊 GRÁFICO (sem SQL — compatível com MongoDB)
        $avaliacoes = DB::table('avaliacoes')->get();

        $grouped = [];

        foreach ($avaliacoes as $a) {
            $hora = isset($a->data_hora)
                ? date('H', strtotime($a->data_hora))
                : date('H');

            if (!isset($grouped[$hora])) {
                $grouped[$hora] = 0;
            }

            $grouped[$hora]++;
        }

        ksort($grouped);

        $labels = array_map(fn($h) => $h . 'h', array_keys($grouped));
        $filaData = array_values($grouped);

        return view('dashboard', compact(
            'seats',
            'totalSeats',
            'soldSeats',
            'reservedSeats',
            'freeSeats',
            'purchases',
            'deadMessages',
            'labels',
            'filaData'
        ));
    }
}
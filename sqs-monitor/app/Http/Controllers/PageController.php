<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Purchase;
use App\Models\DeadMessage;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function seats()
    {
        $seats = Seat::all();
        return view('pages.seats', compact('seats'));
    }

    public function purchases()
    {
        $purchases = Purchase::orderBy('created_at', 'desc')->get();
        return view('pages.purchases', compact('purchases'));
    }

    public function sqs()
    {
        // apenas simulação visual (AWS não guarda histórico direto)
        $logs = DB::table('avaliacoes')->orderBy('data_hora', 'desc')->limit(50)->get();

        return view('pages.sqs', compact('logs'));
    }

    public function dlq()
    {
        $messages = DeadMessage::orderBy('created_at', 'desc')->get();

        return view('pages.dlq', compact('messages'));
    }
}
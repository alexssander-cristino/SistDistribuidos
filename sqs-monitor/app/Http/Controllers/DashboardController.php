<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalSeats' => 100,
            'soldSeats' => 25,
            'purchases' => 30,
            'deadMessages' => 2
        ]);
    }
}
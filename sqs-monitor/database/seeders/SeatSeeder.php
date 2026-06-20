<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    public function run()
    {
        $rows = ['A', 'B', 'C', 'D', 'E'];

        foreach ($rows as $row) {
            for ($i = 1; $i <= 10; $i++) {

                Seat::create([
                    'numero' => $row . $i,
                    'status' => 'livre',
                    'cliente' => null,
                    'expires_at' => null
                ]);
            }
        }
    }
}
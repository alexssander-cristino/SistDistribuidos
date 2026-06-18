<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Aws\Sqs\SqsClient;
use App\Models\Seat;
use App\Models\Purchase;
use App\Models\DeadMessage;

class TicketController extends Controller
{
    public function reserve(Request $request)
    {
        $request->validate([
            'seat' => 'required',
            'cliente' => 'required'
        ]);

        $seat = $request->seat;

        $lock = Redis::set(
            "seat:$seat",
            "locked",
            'NX',
            'EX',
            300
        );

        if (!$lock) {

            return response()->json([
                'success' => false,
                'message' => 'Assento em processo de compra'
            ], 409);
        }

        $sqs = new SqsClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION')
        ]);

        $sqs->sendMessage([
            'QueueUrl' => env('AWS_SQS_QUEUE_URL'),
            'MessageBody' => json_encode([
                'seat' => $seat,
                'cliente' => $request->cliente
            ])
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Solicitação enviada para processamento'
        ]);
    }

    public function listSeats()
    {
        $seats = Seat::orderBy('numero')->get();

        return response()->json($seats);
    }

    public function purchases()
    {
        $purchases = Purchase::orderBy('created_at', 'desc')->get();

        return response()->json($purchases);
    }

    public function dlq()
    {
        $messages = DeadMessage::orderBy('created_at', 'desc')->get();

        return response()->json($messages);
    }
}
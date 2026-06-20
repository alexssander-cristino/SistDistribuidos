<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Aws\Sqs\SqsClient;
use App\Models\Purchase;
use App\Models\Seat;
use App\Models\DeadMessage;
use Exception;

class SqsConsumer extends Command
{
    protected $signature = 'sqs:consume';
    protected $description = 'Consume AWS SQS messages';

    public function handle()
    {
        $this->info("Consumer SQS iniciado...");

        $sqs = new SqsClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY')
            ]
        ]);

        while (true) {

            try {
                $result = $sqs->receiveMessage([
                    'QueueUrl' => env('AWS_SQS_QUEUE_URL'),
                    'MaxNumberOfMessages' => 10,
                    'WaitTimeSeconds' => 10
                ]);

                if (!empty($result->get('Messages'))) {

                    foreach ($result->get('Messages') as $message) {

                        $body = json_decode($message['Body'], true);

                        if (!$body) {
                            continue;
                        }

                        // 🔥 PROCESSA COMPRA
                        Purchase::create([
                            'seat' => $body['seat'] ?? null,
                            'cliente' => $body['cliente'] ?? null,
                            'status' => 'processado'
                        ]);

                        // 🪑 ATUALIZA ASSENTO
                        Seat::where('numero', $body['seat'])
                            ->update(['status' => 'vendido']);

                        // 🧹 REMOVE DA FILA
                        $sqs->deleteMessage([
                            'QueueUrl' => env('AWS_SQS_QUEUE_URL'),
                            'ReceiptHandle' => $message['ReceiptHandle']
                        ]);

                        $this->info("Processado: {$body['seat']} - {$body['cliente']}");
                    }
                }

            } catch (Exception $e) {

                DeadMessage::create([
                    'seat' => $body['seat'] ?? null,
                    'cliente' => $body['cliente'] ?? null,
                    'error' => $e->getMessage()
                ]);

                $this->error("Erro: " . $e->getMessage());
            }
        }
    }
}
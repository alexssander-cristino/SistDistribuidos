<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Aws\Sqs\SqsClient;
use App\Models\Purchase;
use App\Models\Seat;
use Illuminate\Support\Facades\Redis;

class ProcessPurchases extends Command
{
    protected $signature = 'tickets:consume';

    public function handle()
    {
        $sqs = new SqsClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION')
        ]);

        while (true) {

            $result = $sqs->receiveMessage([
                'QueueUrl' => env('AWS_SQS_QUEUE_URL'),
                'MaxNumberOfMessages' => 1,
                'WaitTimeSeconds' => 20
            ]);

            if (!isset($result['Messages'])) {
                continue;
            }

            foreach ($result['Messages'] as $message) {

                $data = json_decode(
                    $message['Body'],
                    true
                );

                try {

                    $pagamentoAprovado =
                        rand(1,100) > 20;

                    if (!$pagamentoAprovado) {
                        throw new \Exception(
                            "Pagamento recusado"
                        );
                    }

                    Seat::updateOrCreate(
                        [
                            'numero'=>$data['seat']
                        ],
                        [
                            'status'=>'vendido',
                            'cliente'=>$data['cliente']
                        ]
                    );

                    Purchase::create([
                        'seat'=>$data['seat'],
                        'cliente'=>$data['cliente'],
                        'status'=>'approved'
                    ]);

                    Redis::del(
                        "seat:".$data['seat']
                    );

                    $sqs->deleteMessage([
                        'QueueUrl' =>
                        env('AWS_SQS_QUEUE_URL'),
                        'ReceiptHandle' =>
                        $message['ReceiptHandle']
                    ]);

                } catch (\Exception $e) {

                    Purchase::create([
                        'seat'=>$data['seat'],
                        'cliente'=>$data['cliente'],
                        'status'=>'failed'
                    ]);

                }
            }
        }
    }
}
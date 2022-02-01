<?php

namespace App\Console\RabbitMQ\Commands;

use Domain\Purchase\Actions\SendPurchaseMailAction;
use Illuminate\Console\Command;
use Infra\Amqp\RabbitMQ;

class PurchaseMailSubscribe extends Command
{
    protected $signature = 'purchase:subscribe';

    protected $description = 'For purchase mail receiving';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \ErrorException
     */
    public function handle()
    {
        $connection = RabbitMQ::create();
        $channel = $connection->channel();

        $channel->queue_declare('purchase_email', false, false, false, false);

        $channel->basic_consume('purchase_email', '', false, true, false, false, function ($message) {
            $purchaseData = json_decode($message->body, true);
            $sendPurchaseMail = new SendPurchaseMailAction;

            $sendPurchaseMail($purchaseData);
        });

        while ($channel->is_open()) {
            $channel->wait();
        }
    }
}

<?php

namespace Domain\Purchase\Listeners;

use Domain\Purchase\Events\CreatePurchaseEvent;
use Illuminate\Support\Facades\Log;
use Infra\Amqp\RabbitMessage;
use Infra\Amqp\RabbitMQ;

class SendPurchaseMail
{
    public function __construct()
    {
        //
    }

    /**
     * @throws \Exception
     */
    public function handle(CreatePurchaseEvent $event)
    {
        $connection = RabbitMQ::create();
        $message = new RabbitMessage(json_encode($event->purchase()));

        $channel = $connection->channel();
        $channel->queue_declare('purchase_email', false, false, false, false);

        $channel->basic_publish($message, '', 'purchase_email');

        $channel->close();
        $connection->close();
    }
}

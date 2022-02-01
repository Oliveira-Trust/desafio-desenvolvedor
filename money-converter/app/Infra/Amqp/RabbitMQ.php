<?php

namespace Infra\Amqp;

use PhpAmqpLib\Connection\AMQPStreamConnection;

final class RabbitMQ
{
    public static function create(): AMQPStreamConnection
    {
        return new AMQPStreamConnection(
            config('rabbitMQ.host'),
            config('rabbitMQ.port'),
            config('rabbitMQ.user'),
            config('rabbitMQ.password'),
        );
    }
}

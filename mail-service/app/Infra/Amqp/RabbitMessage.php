<?php

namespace Infra\Amqp;

use PhpAmqpLib\Message\AMQPMessage;

final class RabbitMessage extends AMQPMessage
{
    public function __construct($body = '', $properties = array())
    {
        parent::__construct($body, $properties);
    }
}

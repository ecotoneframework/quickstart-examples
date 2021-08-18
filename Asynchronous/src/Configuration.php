<?php

namespace App\Asynchronous;

use Ecotone\Amqp\AmqpBackedMessageChannelBuilder;
use Ecotone\Messaging\Attribute\ServiceContext;

class Configuration
{
    #[ServiceContext]
    public function enableRabbitMQ()
    {
        return AmqpBackedMessageChannelBuilder::create(NotificationService::ASYNCHRONOUS_MESSAGES);
    }
}
<?php

use App\Asynchronous\NotificationService;
use App\Asynchronous\OrderWasPlaced;
use Ecotone\Lite\EcotoneLiteApplication;
use Enqueue\AmqpExt\AmqpConnectionFactory;

require __DIR__ . "/vendor/autoload.php";
$messagingSystem = EcotoneLiteApplication::boostrap([Enqueue\AmqpExt\AmqpConnectionFactory::class => new AmqpConnectionFactory("amqp://guest:guest@rabbitmq:5672/%2f")]);

$messagingSystem->getEventBus()->publish(new OrderWasPlaced(1, "Milk"));

echo "Running consumer (ctrl+c and wait few seconds to stop it)\n";
$messagingSystem->run(NotificationService::ASYNCHRONOUS_MESSAGES);
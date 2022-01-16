<?php

use App\Asynchronous\NotificationService;
use App\Asynchronous\OrderWasPlaced;
use Ecotone\Modelling\EventBus;
use Enqueue\AmqpExt\AmqpConnectionFactory;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/../ecotone-lite.php";
/** @var Ecotone\Messaging\Config\ConfiguredMessagingSystem $messagingSystem */
$messagingSystem = createMessaging([Enqueue\AmqpExt\AmqpConnectionFactory::class => new AmqpConnectionFactory("amqp://guest:guest@rabbitmq:5672/%2f")], "App\Asynchronous", "Asynchronous");;

/** @var EventBus $eventBus */
$eventBus = $messagingSystem->getGatewayByName(EventBus::class);

$eventBus->publish(new OrderWasPlaced(1, "Milk"));

echo "Running consumer (ctrl+c and wait few seconds to stop it)\n";
$messagingSystem->run(NotificationService::ASYNCHRONOUS_MESSAGES);
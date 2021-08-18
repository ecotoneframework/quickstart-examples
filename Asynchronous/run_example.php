<?php

use App\Asynchronous\NotificationService;
use App\Asynchronous\OrderWasPlaced;
use Ecotone\Modelling\EventBus;
use Enqueue\AmqpExt\AmqpConnectionFactory;

require __DIR__ . "/vendor/autoload.php";

$catalog = "Asynchronous";
$namespaceToLoad = "App\Asynchronous";
$containerServices = [Enqueue\AmqpExt\AmqpConnectionFactory::class => new AmqpConnectionFactory("amqp://guest:guest@rabbitmq:5672/%2f")];
/** @var Ecotone\Messaging\Config\ConfiguredMessagingSystem $messagingSystem */
require __DIR__ . "/../ecotone-lite.php";

/** @var EventBus $eventBus */
$eventBus = $messagingSystem->getGatewayByName(EventBus::class);

$eventBus->publish(new OrderWasPlaced(1, "Milk"));

echo "Running consumer (ctrl+c and wait few seconds to stop it)\n";
$messagingSystem->run(NotificationService::ASYNCHRONOUS_MESSAGES);
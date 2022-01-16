<?php

use App\EventHandling\OrderWasPlaced;
use Ecotone\Modelling\EventBus;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/../ecotone-lite.php";
$messagingSystem = createMessaging([], "App\EventHandling", "EventHandling");

/** @var EventBus $eventBus */
$eventBus = $messagingSystem->getGatewayByName(EventBus::class);

$eventBus->publish(new OrderWasPlaced(1, "Milk"));

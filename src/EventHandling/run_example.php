<?php

use App\EventHandling\OrderWasPlaced;
use Ecotone\Modelling\EventBus;

$namespaceToLoad = "App\EventHandling";
/** @var Ecotone\Messaging\Config\ConfiguredMessagingSystem $messagingSystem */
require __DIR__ . "/../../ecotone-lite.php";

/** @var EventBus $eventBus */
$eventBus = $messagingSystem->getGatewayByName(EventBus::class);

$eventBus->publish(new OrderWasPlaced(1, "Milk"));

<?php

use App\Conversion\OrderService;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;

$catalog = "Conversion";
$namespaceToLoad = "App\Conversion";
/** @var Ecotone\Messaging\Config\ConfiguredMessagingSystem $messagingSystem */
require __DIR__ . "/../ecotone-lite.php";

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);

$commandBus->sendWithRouting(OrderService::PLACE_ORDER, json_encode(["orderId" => 1, "productName" => null]), "application/json");

echo $queryBus->sendWithRouting(OrderService::GET_ORDER, json_encode(["orderId" => 1]), "application/json");

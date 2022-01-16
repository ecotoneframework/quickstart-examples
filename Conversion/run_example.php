<?php

use App\Conversion\OrderService;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/../ecotone-lite.php";
$messagingSystem = createMessaging([], "App\Conversion", "Conversion");

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);

$commandBus->sendWithRouting(OrderService::PLACE_ORDER, json_encode(["orderId" => 1, "productName" => null]), "application/json");

echo $queryBus->sendWithRouting(OrderService::GET_ORDER, json_encode(["orderId" => 1]), "application/json");

<?php

use App\Conversion\OrderService;
use Ecotone\Lite\EcotoneLiteApplication;

require __DIR__ . "/vendor/autoload.php";
$messagingSystem = EcotoneLiteApplication::boostrap();

$messagingSystem->getCommandBus()->sendWithRouting(OrderService::PLACE_ORDER, json_encode(["orderId" => 1, "productName" => null]), "application/json");

echo $messagingSystem->getQueryBus()->sendWithRouting(OrderService::GET_ORDER, json_encode(["orderId" => 1]), "application/json");

<?php

use App\CQRS\GetOrder;
use App\CQRS\PlaceOrder;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/../ecotone-lite.php";
$messagingSystem = createMessaging([], "App\CQRS", "CQRS");

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);

$commandBus->send(new PlaceOrder(1, "Milk"));

echo $queryBus->send(new GetOrder(1)) . "\n";

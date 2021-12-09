<?php

use App\EventSourcing\Command\ChangePrice;
use App\EventSourcing\Command\RegisterProduct;
use App\EventSourcing\PriceChange;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;
use PHPUnit\Framework\Assert;

$catalog = "EventSourcing";
$namespaceToLoad = "App\EventSourcing";
/** @var Ecotone\Messaging\Config\ConfiguredMessagingSystem $messagingSystem */
require __DIR__ . "/../ecotone-lite.php";

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);

/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);


$productId = 1;
$commandBus->send(new RegisterProduct($productId, 100));

Assert::assertEquals([new PriceChange(100, 0)], $queryBus->sendWithRouting("product.getPriceChange", $productId), "Price change should equal to 0 after registration");

$commandBus->send(new ChangePrice($productId, 120));

Assert::assertEquals([new PriceChange(100, 0), new PriceChange(120, 20)], $queryBus->sendWithRouting("product.getPriceChange", $productId), "Price change should equal to 0 after registration");
<?php

namespace App\Conversion;

use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Gateway\Converter\Serializer;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\QueryHandler;

class OrderService
{
    const PLACE_ORDER = "order.place";
    const GET_ORDER = "order.get";

    private array $orders;

    #[CommandHandler(self::PLACE_ORDER)]
    public function placeOrder(PlaceOrder $command, Serializer $serializer) : void
    {
        $targetMediaType = MediaType::createApplicationJson()->toString();
        var_dump($targetMediaType, $serializer->convertFromPHP($command, $targetMediaType));
        die("test");
        $this->orders[$command->getOrderId()] = $command->getProductName();
    }

    #[QueryHandler(self::GET_ORDER)]
    public function getOrder(GetOrder $query) : string
    {
         if (!array_key_exists($query->getOrderId(), $this->orders)) {
             throw new \InvalidArgumentException("Order was not found " . $query->getOrderId());
         }

         return $this->orders[$query->getOrderId()];
    }
}
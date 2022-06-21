<?php

namespace App\ReadModel;

use App\ReadModel\WalletBalance\TicketCounterWasChanged;
use Ecotone\Modelling\Attribute\EventHandler;
use Ecotone\Modelling\Attribute\QueryHandler;

final class NotificationService
{
    #[EventHandler]
    public function when(TicketCounterWasChanged $event): void
    {
        // we could for example send websocket message here
        echo sprintf("Current count of tickets is %d\n", $event->currentAmount);
    }
}
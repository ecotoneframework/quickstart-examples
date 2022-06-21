<?php

namespace App\ReadModel\WalletBalance;

use App\Domain\Event\MoneyWasAddedToWallet;
use App\Domain\Event\MoneyWasSubtractedFromWallet;
use App\Domain\Event\TicketWasRegistered;
use App\Domain\Ticket;
use Ecotone\EventSourcing\Attribute\Projection;
use Ecotone\EventSourcing\Attribute\ProjectionState;
use Ecotone\EventSourcing\EventStreamEmitter;
use Ecotone\Messaging\Store\Document\DocumentStore;
use Ecotone\Modelling\Attribute\EventHandler;

#[Projection("ticket_counter", Ticket::class)]
final class TicketCounterProjection
{
    #[EventHandler]
    public function when(TicketWasRegistered $event, #[ProjectionState] TicketCounterState $state, EventStreamEmitter $eventStreamEmitter): TicketCounterState
    {
        $state = $state->increase();

        $eventStreamEmitter->emit([new TicketCounterWasChanged($state->count)]);

        return $state;
    }
}
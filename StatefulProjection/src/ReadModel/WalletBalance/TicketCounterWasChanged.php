<?php

namespace App\ReadModel\WalletBalance;

final class TicketCounterWasChanged
{
    public function __construct(public readonly int $currentAmount){}
}
<?php

namespace App\ReadModel\WalletBalance;

final class TicketCounterState
{
    public function __construct(public readonly int $count) {}

    public function increase(): self
    {
        return new self($this->count + 1);
    }
}
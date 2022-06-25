<?php

namespace App\ReadModel\TicketCounterProjection;

final class WalletBalanceWasChanged
{
    public function __construct(
        public readonly string $walletId,
        public readonly int $currentBalance
    ){}
}
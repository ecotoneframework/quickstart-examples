<?php

namespace App\Schedule\Messaging\StaticSchedules;

class UserWasRegistered
{
    public function __construct(public readonly string $userId)
    {
    }
}
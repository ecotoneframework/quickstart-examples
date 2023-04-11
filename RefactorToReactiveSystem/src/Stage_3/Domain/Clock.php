<?php

declare(strict_types=1);

namespace App\ReactiveSystem\Stage_3\Domain;

interface Clock
{
    public function getCurrentTime(): \DateTimeImmutable;
}
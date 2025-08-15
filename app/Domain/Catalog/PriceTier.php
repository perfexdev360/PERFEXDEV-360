<?php

namespace App\Domain\Catalog;

class PriceTier
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly float $price,
        public readonly ?string $currency = 'USD',
    ) {
    }
}

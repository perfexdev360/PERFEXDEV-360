<?php

namespace App\Domain\Catalog;

class Feature
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $description = null,
    ) {
    }
}

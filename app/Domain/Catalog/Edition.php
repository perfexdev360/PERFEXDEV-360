<?php

namespace App\Domain\Catalog;

class Edition
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $description = null,
    ) {
    }
}

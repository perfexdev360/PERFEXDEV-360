<?php

namespace App\Domain\Catalog;

class Tag
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $slug = null,
    ) {
    }
}

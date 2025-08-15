<?php

namespace App\Domain\Catalog;

class Category
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $slug = null,
    ) {
    }
}

<?php

namespace App\Domain\Catalog;

class Dependency
{
    public function __construct(
        public readonly Product $product,
        public readonly Product $requires,
        public readonly ?string $minVersion = null,
        public readonly ?string $maxVersion = null,
    ) {
    }
}

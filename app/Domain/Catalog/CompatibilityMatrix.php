<?php

namespace App\Domain\Catalog;

class CompatibilityMatrix
{
    public function __construct(
        public readonly Product $product,
        public readonly Product $compatibleWith,
        public readonly ?string $minVersion = null,
        public readonly ?string $maxVersion = null,
    ) {
    }
}

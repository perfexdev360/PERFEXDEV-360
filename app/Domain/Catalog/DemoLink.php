<?php

namespace App\Domain\Catalog;

class DemoLink
{
    public function __construct(
        public readonly string $url,
        public readonly string $label,
    ) {
    }
}

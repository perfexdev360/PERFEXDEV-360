<?php

namespace App\Domain\Catalog;

class DocsLink
{
    public function __construct(
        public readonly string $url,
        public readonly string $label,
    ) {
    }
}

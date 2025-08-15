<?php

namespace App\Domain\Catalog;

class Screenshot
{
    public function __construct(
        public readonly string $url,
        public readonly ?string $caption = null,
    ) {
    }
}

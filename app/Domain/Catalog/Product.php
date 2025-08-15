<?php

namespace App\Domain\Catalog;

class Product
{
    /**
     * @param Edition[] $editions
     * @param Feature[] $features
     * @param Screenshot[] $screenshots
     * @param DocsLink[] $docsLinks
     * @param DemoLink[] $demoLinks
     * @param PriceTier[] $priceTiers
     * @param Tag[] $tags
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $slug = null,
        public readonly ?string $description = null,
        public readonly ?Category $category = null,
        public readonly array $editions = [],
        public readonly array $features = [],
        public readonly array $screenshots = [],
        public readonly array $docsLinks = [],
        public readonly array $demoLinks = [],
        public readonly array $priceTiers = [],
        public readonly array $tags = [],
    ) {
    }
}

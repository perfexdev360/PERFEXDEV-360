<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Release;
use Illuminate\Support\Facades\Storage;

class FeedService
{
    public function updateProductFeed(Product $product): void
    {
        $releases = Release::where('product_id', $product->id)
            ->where('is_published', true)
            ->orderByDesc('released_at')
            ->with('version')
            ->take(20)
            ->get();

        $feed = new \SimpleXMLElement('<feed xmlns="http://www.w3.org/2005/Atom"/>');
        $feed->addChild('title', $product->name);
        $feed->addChild('updated', optional($releases->first())->released_at?->toAtomString() ?? now()->toAtomString());

        foreach ($releases as $release) {
            $entry = $feed->addChild('entry');
            $entry->addChild('title', 'v' . $release->version->number);
            $entry->addChild('id', (string) $release->id);
            $entry->addChild('updated', optional($release->released_at)->toAtomString() ?? now()->toAtomString());
            if ($release->notes) {
                $entry->addChild('content', htmlspecialchars(json_encode($release->notes)));
            }
        }

        Storage::disk('public')->put('feeds/product-' . $product->id . '.xml', $feed->asXML());
    }
}

<?php

namespace App\Services\AI;

use App\Jobs\GenerateBlogPost;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContentPlanner
{
    /**
     * Scan the sitemap for internal links and enqueue blog generation jobs.
     */
    public function plan(): void
    {
        if (! config('features.ai_content_engine')) {
            return;
        }

        foreach ($this->discoverInternalLinks() as $url) {
            GenerateBlogPost::dispatch($url);
        }
    }

    /**
     * Retrieve internal URLs from the site's sitemap.
     *
     * @return array<int, string>
     */
    protected function discoverInternalLinks(): array
    {
        $sitemapUrl = url('/sitemap.xml');

        try {
            $response = Http::get($sitemapUrl);
            $xml = simplexml_load_string($response->body());

            $links = [];

            foreach ($xml->url as $entry) {
                $loc = (string) $entry->loc;

                if (str_starts_with($loc, config('app.url'))) {
                    $links[] = $loc;
                }
            }

            return $links;
        } catch (\Throwable $e) {
            Log::error('Failed to read sitemap', ['exception' => $e]);
        }

        return [];
    }
}

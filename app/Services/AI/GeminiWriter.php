<?php

namespace App\Services\AI;

use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Str;

class GeminiWriter
{
    /**
     * Draft a blog post using Gemini with meta and JSON-LD.
     *
     * @param  string  $topic
     * @param  array<int, string>  $links
     * @return array<string, mixed>
     */
    public function draft(string $topic, array $links = []): array
    {
        if (! config('features.ai_content_engine')) {
            return [];
        }

        $prompt = $this->prompt($topic, $links);

        $response = Gemini::generateContent($prompt);
        $data = json_decode($response->text(), true) ?? [];

        $body = $this->ensureInternalLinks($data['body'] ?? '', $links);

        return [
            'title' => $data['title'] ?? Str::title($topic),
            'meta_title' => $data['meta_title'] ?? ($data['title'] ?? Str::title($topic)),
            'meta_description' => $data['meta_description'] ?? Str::limit(strip_tags($body), 160),
            'body' => $body,
            'json_ld' => $data['json_ld'] ?? [],
        ];
    }

    protected function prompt(string $topic, array $links): string
    {
        $linkList = implode("\n", $links);

        return <<<PROMPT
Write a detailed blog post about "{$topic}" for perfexdev360.com.

Requirements:
- Include at least three internal links from the following list:
{$linkList}
- Provide meta title and meta description.
- Include valid JSON-LD for a BlogPosting.
Return your answer as JSON with keys: title, meta_title, meta_description, body, json_ld.
PROMPT;
    }

    protected function ensureInternalLinks(string $body, array $links): string
    {
        $count = preg_match_all('/href="https?:\\/\\/[^\"]+"/', $body);
        $missing = max(0, 3 - $count);
        $extra = array_slice($links, 0, $missing);

        foreach ($extra as $url) {
            $body .= "\n<a href=\"{$url}\">Related</a>";
        }

        return $body;
    }
}

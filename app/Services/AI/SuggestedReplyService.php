<?php

namespace App\Services\AI;

use Gemini\Laravel\Facades\Gemini;

class SuggestedReplyService
{
    /**
     * Generate a suggested reply for support tickets using Gemini.
     */
    public function suggest(string $question): string
    {
        if (! config('features.ai_content_engine')) {
            return '';
        }

        $response = Gemini::generateContent("Reply to: {$question}");

        return trim($response->text());
    }
}

<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\Service;
use Illuminate\Support\Collection;

class ServiceMatcher
{
    /**
     * Suggest services for a given lead using tag overlap.
     */
    public function suggestForLead(Lead $lead): Collection
    {
        $lead->loadMissing('serviceRequests');
        $leadTags = $lead->tags();

        return Service::with('options')
            ->get()
            ->map(function (Service $service) use ($leadTags) {
                $score = $leadTags->intersect($service->tags())->count();

                return ['service' => $service, 'score' => $score];
            })
            ->filter(fn ($data) => $data['score'] > 0)
            ->sortByDesc('score')
            ->pluck('service');
    }
}

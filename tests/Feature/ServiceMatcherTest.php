<?php

use App\Models\Lead;
use App\Models\PipelineStage;
use App\Models\Service;
use App\Services\ServiceMatcher;

it('suggests services based on lead tags', function () {
    PipelineStage::factory()->create(['order' => 1]);

    $service = Service::create([
        'name' => 'Customization',
        'slug' => 'customization',
        'category' => 'web',
    ]);

    $service->options()->create([
        'name' => 'Laravel',
        'slug' => 'laravel',
        'type' => 'boolean',
        'price_delta' => 0,
    ]);

    $lead = Lead::create([
        'name' => 'Test Lead',
        'source' => 'test',
        'pipeline_stage_id' => 1,
        'tech_stack' => 'laravel,vue',
    ]);

    $matcher = new ServiceMatcher();

    $suggestions = $matcher->suggestForLead($lead);

    expect($suggestions->pluck('id'))->toContain($service->id);
});


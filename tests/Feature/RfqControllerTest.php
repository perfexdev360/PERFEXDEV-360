<?php

use App\Models\PipelineStage;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\LeadAttachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('creates lead and draft quote from rfq', function () {
    Storage::fake('local');

    PipelineStage::factory()->create(['order' => 1]);

    $service = Service::create([
        'name' => 'Customization',
        'slug' => 'customization',
    ]);

    $option = $service->options()->create([
        'name' => 'Integration',
        'slug' => 'integration',
        'type' => 'boolean',
        'price_delta' => 1000,
    ]);

    $file = UploadedFile::fake()->create('spec.pdf', 20, 'application/pdf');

    $response = $this->post(route('rfq.store', $service), [
        'options' => [
            $option->slug => '1',
        ],
        'notes' => 'Need integration',
        'files' => [$file],
    ]);

    $response->assertRedirect();

    $serviceRequest = ServiceRequest::first();
    $lead = $serviceRequest->lead;
    $quote = $lead->quotes()->first();

    expect($lead->notes)->toBe('Need integration');
    expect($lead->tech_stack)->toContain('integration');
    expect($quote->status)->toBe('draft');
    expect($quote->items)->toHaveCount(1);
    expect($quote->items->first()->title)->toBe('Integration');

    Storage::disk('local')->assertExists(LeadAttachment::first()->path);
});


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use function Spatie\Activitylog\activity;

class ServiceRequest extends Model
{
    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'selected_options' => 'array',
    ];

    /**
     * Service related to the request.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Lead generated from the request.
     */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Handle model events.
     */
    protected static function booted(): void
    {
        static::created(function (ServiceRequest $request): void {
            $stage = PipelineStage::orderBy('order')->first();

            $lead = Lead::create([
                'name' => 'Lead #' . $request->id,
                'source' => 'service-request',
                'pipeline_stage_id' => $stage?->id,
            ]);

            $request->lead()->associate($lead);
            $request->save();

            $quote = Quote::create([
                'lead_id' => $lead->id,
                'number' => Str::uuid(),
                'status' => 'draft',
            ]);

            activity()->performedOn($request)->withProperties([
                'lead_id' => $lead->id,
                'quote_id' => $quote->id,
            ])->log('service_request_submitted');

            activity()->performedOn($lead)->log('lead_created_from_service_request');

            activity()->performedOn($quote)->log('draft_quote_created');
        });
    }
}


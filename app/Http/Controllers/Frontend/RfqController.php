<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LeadAttachment;
use App\Models\QuoteItem;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RfqController extends Controller
{
    /**
     * Store a new RFQ and generate related lead and quote.
     */
    public function store(Request $request, Service $service): RedirectResponse
    {
        $data = $request->validate([
            'options' => ['array'],
            'options.*' => ['nullable'],
            'notes' => ['nullable', 'string'],
            'files.*' => ['file', 'max:10240'],
        ]);

        $serviceRequest = ServiceRequest::create([
            'service_id' => $service->id,
            'selected_options' => $data['options'] ?? [],
            'notes' => $data['notes'] ?? null,
        ]);

        $serviceRequest->refresh();

        $lead = $serviceRequest->lead;
        $lead->update([
            'notes' => $data['notes'] ?? null,
            'tech_stack' => collect($serviceRequest->selected_options ?? [])->keys()->implode(','),
        ]);

        $quote = $lead->quotes()->first();

        foreach ($service->options()->whereIn('slug', array_keys($serviceRequest->selected_options ?? []))->get() as $option) {
            $value = $serviceRequest->selected_options[$option->slug] ?? null;
            if ($option->type === 'boolean' && ! in_array($value, [true, 1, '1', 'on'], true)) {
                continue;
            }

            $qty = 1;
            $unitPrice = $option->price_delta;
            $description = null;

            if ($option->type === 'number' && is_numeric($value)) {
                $qty = (int) $value;
            } elseif ($option->type === 'select') {
                $choice = data_get($option->config, 'choices.' . $value);
                if ($choice) {
                    $unitPrice = $choice['price_delta'] ?? $unitPrice;
                    $description = $choice['label'] ?? $value;
                }
            }

            QuoteItem::create([
                'quote_id' => $quote->id,
                'title' => $option->name,
                'description' => $description,
                'qty' => $qty,
                'unit_price' => $unitPrice,
            ]);
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('leads');

                LeadAttachment::create([
                    'lead_id' => $serviceRequest->lead_id,
                    'path' => $path,
                    'disk' => config('filesystems.default'),
                    'size' => $file->getSize(),
                    'mime' => $file->getClientMimeType(),
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('services.show', $service)->with('status', 'Request submitted');
    }
}

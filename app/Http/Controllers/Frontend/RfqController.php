<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LeadAttachment;
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

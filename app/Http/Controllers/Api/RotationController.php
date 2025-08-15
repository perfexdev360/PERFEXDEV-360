<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function activity;

class RotationController extends Controller
{
    /**
     * Rotate an existing license activation.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validate([
            'license_key' => 'required|string',
            'activation_id' => 'required|integer',
            'domain' => 'nullable|string',
            'ip_hash' => 'nullable|string',
            'fingerprint' => 'nullable|string',
            'meta' => 'array',
        ]);

        $license = License::where('license_key', $data['license_key'])->firstOrFail();

        if ($license->is_revoked) {
            return response()->json(['message' => 'License revoked'], 403);
        }

        $activation = $license->activations()->findOrFail($data['activation_id']);
        $activation->update([
            'domain' => $data['domain'] ?? null,
            'ip_hash' => $data['ip_hash'] ?? null,
            'fingerprint' => $data['fingerprint'] ?? null,
            'meta' => $data['meta'] ?? null,
            'activated_at' => now(),
        ]);

        $license->events()->create([
            'event' => 'rotated',
            'meta' => ['activation_id' => $activation->id],
        ]);

        activity('license')
            ->performedOn($license)
            ->withProperties(['activation_id' => $activation->id])
            ->log('rotated');

        return response()->json(['status' => 'ok']);
    }
}

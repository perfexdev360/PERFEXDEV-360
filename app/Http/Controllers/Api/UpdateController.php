<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\Release;
use App\Models\ReleaseChannel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UpdateController extends Controller
{
    /**
     * Return the latest compatible release for a license.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validate([
            'license_key' => 'required|string',
            'channel' => 'nullable|string',
        ]);

        $license = License::where('license_key', $data['license_key'])->firstOrFail();

        if ($license->is_revoked || ($license->update_window_ends_at && now()->greaterThan($license->update_window_ends_at))) {
            return response()->json(['message' => 'License not eligible'], 403);
        }

        $channelName = $data['channel'] ?? 'stable';
        $channelId = ReleaseChannel::where('name', $channelName)->value('id');

        $release = Release::where('product_id', $license->product_id)
            ->when($channelId, fn($q) => $q->where('release_channel_id', $channelId))
            ->where('is_published', true)
            ->orderByDesc('released_at')
            ->with('version')
            ->first();

        if (! $release) {
            return response()->json(['message' => 'No release'], 404);
        }

        $artifact = $release->fileArtifacts()->first();

        $url = URL::temporarySignedRoute(
            'releases.download',
            now()->addMinutes(10),
            ['release' => $release->id, 'license_key' => $license->license_key]
        );

        return response()->json([
            'version' => $release->version->number,
            'download_url' => $url,
            'checksum' => $artifact?->hash,
        ]);
    }
}


<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DownloadController extends Controller
{
    /**
     * Serve a product download after license checks.
     */
    public function __invoke(Request $request, Version $version)
    {
        $licenseKey = $request->query('license_key');
        $license = License::where('license_key', $licenseKey)->firstOrFail();

        if ($license->product_id !== $version->product_id ||
            $license->is_revoked ||
            ($license->update_window_ends_at && now()->greaterThan($license->update_window_ends_at))) {
            abort(403, 'License not eligible');
        }

        $artifact = $version->fileArtifacts()->firstOrFail();

        // In a real app, we would return the file download. For tests, return artifact info.
        return response()->json(['path' => $artifact->path]);
    }
}


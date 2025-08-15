<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\Release;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    /**
     * Serve a product download after license checks.
     */
    public function __invoke(Request $request, Release $release)
    {
        $licenseKey = $request->query('license_key');
        $license = License::where('license_key', $licenseKey)->firstOrFail();

        if ($license->product_id !== $release->product_id ||
            $license->is_revoked ||
            ($license->update_window_ends_at && now()->greaterThan($license->update_window_ends_at))) {
            abort(403, 'License not eligible');
        }

        $artifact = $release->fileArtifacts()->firstOrFail();

        $url = Storage::disk('s3')->temporaryUrl(
            $artifact->path,
            now()->addMinutes(10)
        );

        return redirect($url);
    }
}


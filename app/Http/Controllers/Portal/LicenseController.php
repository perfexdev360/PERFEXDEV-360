<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\Release;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class LicenseController extends Controller
{
    /**
     * Display a listing of the user's licenses.
     */
    public function index()
    {
        $licenses = auth()->user()
            ->licenses()
            ->with('product')
            ->latest()
            ->get();

        return view('portal.licenses.index', compact('licenses'));
    }

    /**
     * Display the specified license details.
     */
    public function show(License $license)
    {
        abort_if($license->user_id !== auth()->id(), 403);

        $license->load(['product', 'activationHistory']);

        $releases = Release::where('product_id', $license->product_id)
            ->where('is_published', true)
            ->with('fileArtifacts')
            ->latest('released_at')
            ->get();

        return view('portal.licenses.show', [
            'license' => $license,
            'releases' => $releases,
        ]);
    }

    /**
     * Rotate the license key.
     */
    public function rotate(License $license): RedirectResponse
    {
        abort_if($license->user_id !== auth()->id(), 403);

        $license->update([
            'license_key' => Str::uuid()->toString(),
        ]);

        $license->events()->create(['event' => 'rotated']);

        return back()->with('status', 'License key rotated.');
    }

    /**
     * Download a release for this license using a signed URL.
     */
    public function download(License $license, Release $release)
    {
        abort_if($license->user_id !== auth()->id(), 403);
        abort_if($release->product_id !== $license->product_id, 403);

        if ($license->is_revoked ||
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

    /**
     * Generate a temporary signed download URL for a release.
     */
    public function signedDownloadUrl(License $license, Release $release): string
    {
        return URL::temporarySignedRoute(
            'licenses.download',
            now()->addMinutes(5),
            ['license' => $license->id, 'release' => $release->id]
        );
    }
}

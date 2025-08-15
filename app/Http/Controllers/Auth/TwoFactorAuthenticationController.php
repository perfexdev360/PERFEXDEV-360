<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\TwoFactorService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TwoFactorAuthenticationController extends Controller
{
    public function create(Request $request, TwoFactorService $service): View
    {
        $user = $request->user();

        if ($user->two_factor_secret) {
            return view('auth.two-factor-settings');
        }

        $secret = $service->generateSecret();
        $qr = $service->getQRCodeUrl(config('app.name'), $user->email, $secret);

        return view('auth.two-factor-settings', [
            'secret' => $secret,
            'qrCode' => $qr,
        ]);
    }

    public function store(Request $request, TwoFactorService $service): RedirectResponse
    {
        $request->validate([
            'secret' => ['required', 'string'],
            'code' => ['required', 'string'],
        ]);

        if (! $service->verify($request->string('secret'), $request->string('code'))) {
            return back()->withErrors(['code' => __('Invalid authentication code.')]);
        }

        $request->user()->forceFill([
            'two_factor_secret' => $request->string('secret'),
        ])->save();

        return redirect()->route('dashboard', [], false)->with('status', 'two-factor-enabled');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->user()->forceFill([
            'two_factor_secret' => null,
        ])->save();

        return redirect()->route('dashboard', [], false)->with('status', 'two-factor-disabled');
    }
}

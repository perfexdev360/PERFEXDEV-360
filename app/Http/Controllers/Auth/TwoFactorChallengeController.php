<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TwoFactorService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TwoFactorChallengeController extends Controller
{
    public function create(): View
    {
        return view('auth.two-factor-challenge');
    }

    public function store(Request $request, TwoFactorService $service): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $userId = $request->session()->pull('login.id');
        $remember = $request->session()->pull('login.remember', false);
        $user = User::find($userId);

        if (! $user || ! $user->two_factor_secret || ! $service->verify($user->two_factor_secret, $request->string('code'))) {
            return back()->withErrors(['code' => __('The provided authentication code is invalid.')]);
        }

        Auth::login($user, $remember);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', [], false));
    }
}

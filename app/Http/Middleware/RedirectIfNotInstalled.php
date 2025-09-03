<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotInstalled
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('app.installed')
            && ! $request->is('install')
            && ! $request->is('install/*')
            && ! $request->is('build/*')
            && ! $request->is('storage/*')
        ) {
            if (! \file_exists(base_path('.env'))) {
                $installUrl = $request->getSchemeAndHttpHost().$request->getBaseUrl().'/install';

                return redirect()->to($installUrl);
            }

            return redirect()->route('install.show');
        }

        return $next($request);
    }
}

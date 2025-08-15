<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanonicalRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $canonicalHost = parse_url(config('app.url'), PHP_URL_HOST);
        $host = $request->getHost();
        $path = $request->getPathInfo();
        $hasTrailing = $path !== '/' && str_ends_with($path, '/');

        if ($host !== $canonicalHost || $hasTrailing) {
            $path = $hasTrailing ? rtrim($path, '/') : $path;
            $scheme = $request->getScheme();
            $url = $scheme.'://'.$canonicalHost.$path;
            if ($query = $request->getQueryString()) {
                $url .= '?'.$query;
            }
            return redirect($url, 301);
        }

        return $next($request);
    }
}

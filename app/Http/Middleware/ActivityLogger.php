<?php

namespace App\Http\Middleware;

use App\Models\uLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        uLog::record(
            'Visited ' . $request->path(),
            'Navigation',
            'User visited: ' . $request->fullUrl()
        );

        return $response;
    }
}

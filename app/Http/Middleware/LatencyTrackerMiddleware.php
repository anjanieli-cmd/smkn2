<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LatencyTrackerMiddleware
{
    /**
     * Handle an incoming request and track latency in milliseconds.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        /** @var Response $response */
        $response = $next($request);

        $durationMs = round((microtime(true) - $startTime) * 1000, 2);

        $response->headers->set('X-Response-Time-Ms', (string) $durationMs);

        return $response;
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        // Get the host and port of the incoming request
        $host = $request->getHost();
        $port = $request->getPort();

        // Determine the Vite server's URL based on the host and port
        $viteServerUrl = "http://$host:$port"; // Assumes Vite server is running on the same host as Laravel

        return $next($request)
            ->header('Access-Control-Allow-Origin', $viteServerUrl)
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }
}

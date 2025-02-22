<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Handle preflight request (OPTIONS)
        if ($request->getMethod() == "OPTIONS") {
            return response()->json([], 200);
        }

        // Get CORS configuration from config file
        $config = config('cors');

        // Add CORS headers to the response
        $response = $next($request);

        // Add headers using the configuration values
        $response->headers->set('Access-Control-Allow-Origin', $config['allow_origins']);
        $response->headers->set('Access-Control-Allow-Methods', implode(', ', $config['allow_methods']));
        $response->headers->set('Access-Control-Allow-Headers', implode(', ', $config['allow_headers']));
        $response->headers->set('Access-Control-Allow-Credentials', $config['allow_credentials']);

        return $response;
    }
}

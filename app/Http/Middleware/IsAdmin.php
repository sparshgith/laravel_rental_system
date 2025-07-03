<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          // Check if a user is logged in AND if their 'is_admin' property is true.
        if (auth()->check() && auth()->user()->is_admin) {
            // If they are an admin, allow the request to continue.
            return $next($request);
        }

        // If they are not an admin, stop the request and show a 403 Forbidden error.
        abort(403, 'Unauthorized Action.');
    }
}

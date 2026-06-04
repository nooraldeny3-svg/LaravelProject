<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// This middleware protects all admin routes.
// If the logged-in user is NOT an admin, they get a 403 Forbidden error.
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Must be logged in AND have is_admin = true
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Access denied. Admins only.');
        }

        return $next($request);
    }
}

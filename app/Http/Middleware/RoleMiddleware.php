<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login'); // Redirect if not authenticated
        }

        // Allow 'super-admin' to access everything
        if ($user->hasRole('super-admin')) {
            return $next($request);
        }

        // Check if the user has any of the allowed roles
        if (!$user->hasAnyRole($roles)) {
            return abort(403, 'Access denied');
        }

        return $next($request);
    }
}

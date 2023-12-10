<?php

namespace App\Http\Middleware;

use Closure;

class RoleCheckMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Check if the user has the specified role
        if ($request->user()->role_id == $role) {
            return $next($request);
        }

        // Redirect or handle unauthorized access as needed
        return redirect('/login')->with('error', 'Unauthorized access');
    }

    protected $routeMiddleware = [
        // ... other middlewares

        'role.check' => \App\Http\Middleware\RoleCheckMiddleware::class,
    ];
}

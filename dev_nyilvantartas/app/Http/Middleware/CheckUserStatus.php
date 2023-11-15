<?php

// app/Http/Middleware/CheckUserStatus.php

namespace App\Http\Middleware;

use Closure;

class CheckUserStatus
{
    public function handle($request, Closure $next, $status)
    {
        // Check if the authenticated user has the specified status
        if (!$request->user() || $request->user()->status !== admin) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}


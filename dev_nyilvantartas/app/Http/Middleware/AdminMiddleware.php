<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->status !== 'admin') {
            return redirect('dev_nyilvantartas/resources/views/admin/dashboard.blade.php'); // Redirect non-admin users to the home page or any other route
        }

        return $next($request);
    }
}

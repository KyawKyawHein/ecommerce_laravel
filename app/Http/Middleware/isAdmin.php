<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      // Check if the authenticated user has admin role or any other criteria
        if (auth()->check() && auth()->user()->isAdmin) {
            return $next($request);
        }

        // Redirect to the home page or display an error message
        return redirect('/')->with('error', 'Unauthorized access to admin dashboard.');
    }
}

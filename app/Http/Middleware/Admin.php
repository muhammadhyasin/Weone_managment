<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;
    
            // Check the user's role and redirect to the appropriate section
            if ($userRole === 'admin') {
                return $next($request); 
            } elseif ($userRole === 'superadmin') {
                return $next($request); 
            } elseif ($userRole === 'office') {
                return redirect('office');
            } elseif ($userRole === 'driver') {
                return redirect('driver'); // Redirect to driver section
            } else {
                // If no role is assigned, log the user out and redirect to login
                return response("<script>alert('You are not allowed to perform this operation.'); window.location='/';</script>");
            }
        }
    
        // If the user is not authenticated, allow the next request to handle it
        return $next($request);
    }
}

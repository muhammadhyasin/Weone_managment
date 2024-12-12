<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->account_status !== 1) {
            Auth::logout(); 
            return redirect('/login')->with('error', 'Your account is inactive. Please contact support.');
        }

        return $next($request);
    }
}

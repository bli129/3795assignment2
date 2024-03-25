<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class EnsureIsAdmin
{
    public function handle($request, Closure $next)
    {
        $user = Session::get('user');
        
        if (!$user || strtolower($user['role']) !== 'admin') {
            // Flashing an error message to the session
            Session::flash('error', 'Access restricted to administrators.');
            
            // Redirecting to /transactions instead of /
            return redirect('/transactions');
        }

        return $next($request);
    }
}

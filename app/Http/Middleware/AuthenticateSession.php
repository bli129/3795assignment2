<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Models\AppUser;
use Illuminate\Support\Facades\Log;

class AuthenticateSession
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('user')) {
            return redirect('/login')->withErrors(['login_required' => 'Please login to continue.']);
        }
        
        // Retrieve the user from the session
        $userSession = Session::get('user');
        $user = AppUser::find($userSession['id']);

        // Log the user role
        Log::info('User Role: ' . $user->Role);

        if (!$user) {
            Session::forget('user');
            return redirect('/login')->withErrors(['login_error' => 'Session invalid. Please login again.']);
        }

        return $next($request);
    }
}

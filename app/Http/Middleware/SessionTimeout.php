<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    public function handle($request, Closure $next)
    {
        $sessionTimeoutMinutes = 1; // Adjust this value according to your requirements
        $sessionTimeoutSeconds = $sessionTimeoutMinutes * 60;

        $lastActivity = session('last_activity');

        if (isset($lastActivity) && time() - $lastActivity > $sessionTimeoutSeconds) {
            Auth::logout();
            session()->flush();
            return redirect()->route('users.login')->with('session_expired', 'Your session has expired. Please login again.');
        }

        session(['last_activity' => time()]);

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Store;

class SessionTimeout
{
    protected $session;
    protected $timeout = 6; // 10 minutes

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $lastActivity = $this->session->get('last_activity');
        if (isset($lastActivity) && time() - $lastActivity > $this->timeout) {
            Auth::logout();
            $this->session->flush();
            return redirect()->route('home')->with('timeout_message', 'Your session has expired due to inactivity.');
        }

        $this->session->put('last_activity', time());
        return $next($request);
    }
}
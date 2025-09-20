<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('web')->check()) {
            $user = auth('web')->user();
            if ($user->is_disabled) {
                auth('web')->logout();
                return to_route('login')->with(['error' => 'Your account has been banned. Please contact support.']);
            }
        }
        return $next($request);
    }
}

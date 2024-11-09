<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected public function redirectTo(Request $request): ?string {
        if($request->expectsJson()) {
            return null;
        }

        if($request->is('backend/*')) {
            return route('backend.login');
        }
        elseif($request->is('frontend/*')) {
            return route('frontend.login');
        }

        return route('backend.login');
    }
}

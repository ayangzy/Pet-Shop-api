<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUserMiddleware
{
    use ApiResponses;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $this->unauthorisedRequestAlert('Unauthorized');
        }

        if (Auth::user()->is_admin !== 0) {
            return $this->unauthorisedRequestAlert('Access Restricted to users only');
        }
        return $next($request);
    }
}

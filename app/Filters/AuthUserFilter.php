<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AuthUserFilter
{
    public function handle(Builder $query, Closure $next)
    {
        $query->where('user_id', Auth::id());

        return $next($query);
    }
}

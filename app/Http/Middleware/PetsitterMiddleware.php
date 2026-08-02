<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class PetsitterMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->is_petsitter){
            abort(403);
        }

        return $next($request);
    }
}

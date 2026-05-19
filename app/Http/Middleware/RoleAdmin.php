<?php

namespace App\Http\Middleware;

use App\enum\UserRole;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $user = Auth::user();

      if ($user->role !==UserRole::ADMIN){
          abort(403);
      }
            return $next($request);
    }
}

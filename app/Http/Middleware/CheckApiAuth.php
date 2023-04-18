<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckApiAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::guard('sanctum')->check()) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        return $next($request);
    }

}
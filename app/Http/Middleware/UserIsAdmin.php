<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->roles != "admin"){
            return response()->json([
                'status' => 'forbidden',
                'message' => 'You Are Not Permitted'
            ], 403);
        }
        
        return $next($request);
    }
}

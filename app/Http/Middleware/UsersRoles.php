<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersRoles
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

        if(!Auth::check()){
            return response()->json([
                'status' => 'forbidden',
                'message' => 'You Are Not Logged In'
            ]);
        }

        $user = $request->user();

        if(in_array($user->roles, ["admin", "kasir", "gudang"])){
            return $next($request);
        }

        return response()->json([
            'status' => 'forbidden',
            'message' => 'You Are Not Logged In'
        ]);
        
        // return $next($request);

    }
}

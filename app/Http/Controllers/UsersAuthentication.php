<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UsersAuthentication extends Controller
{
    function login(UserLoginRequest $request){        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            return response([
                'status' => 'success',
                'data' => [
                    'email' => $user->email,
                    'token' => $user->createToken('api-token')->accessToken,
                ],
            ], 201);
        }else {
            return response([
                'status' => 'error',
                'message' => 'Wrong Email or Password',
                'data' => []
            ], 203);
        }
    }

    public function logout(){
        if(Auth::check()){
            $user = Auth::user()->token();
            $user->revoke();
            return response([
                'status' => 'success',
                'message' => 'Logout Successfully',
                'data' => [],
            ], 200);
        }
        return response([
            'status' => 'error',
            'message' => 'You are not logged in',
            'data' => []
        ], 401);
    }
}

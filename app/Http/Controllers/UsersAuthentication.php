<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UsersAuthentication extends Controller
{
    function login(Request $request){
        $checkUserInput = $this->validateInputUser($request);
        if($checkUserInput->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $checkUserInput->errors()->all()
            ], 400);
        }
        
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
            ], 203);
        }
    }

    private function validateInputUser(Request $request){
        return Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)->mixedCase()]
        ]);
    }
}

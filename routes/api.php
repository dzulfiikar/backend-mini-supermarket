<?php

use App\Http\Controllers\UsersAuthentication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', [UsersAuthentication::class, 'login']);

Route::middleware(['auth:api'])->group(function (){
    Route::middleware('roles:admin')->group(function(){
        Route::get('/admin', function () {
            return response()->json([
                'status' => 'success',
                'message' => 'isAdmin'
            ], 200);
        });
    });

    Route::middleware('roles:kasir')->group(function(){
        Route::get('users/', function () {
            return response()->json([
                'status' => 'success',
                'message' => 'isKasir'
            ], 200);
        });
    });
});

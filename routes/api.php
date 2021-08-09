<?php

use App\Http\Controllers\UserController;
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
    Route::middleware('role:admin')->group(function(){
        
        Route::get('/admin/user', [UserController::class, 'index']);
        Route::post('/admin/user', [UserController::class, 'store']);
        Route::get('/admin/user/{id}', [UserController::class, 'show']);
        Route::delete('users/{id}', [UserController::class, 'destroy']);
    }); 
});

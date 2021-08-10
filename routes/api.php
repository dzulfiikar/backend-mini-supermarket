<?php

use App\Http\Controllers\ProductsController;
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
        Route::put('/admin/user/{id}', [UserController::class, 'update']);
        Route::delete('admin/user/{id}', [UserController::class, 'destroy']);
    }); 

    Route::middleware(['role:gudang'])->group(function(){
        Route::get('/gudang/product', [ProductsController::class, 'index']);
        Route::post('/gudang/product', [ProductsController::class, 'store']);
        Route::get('/gudang/product/{id}', [ProductsController::class, 'show']);
        Route::put('/gudang/product/{id}', [ProductsController::class, 'update']);
        Route::delete('/gudang/product/{id}', [ProductsController::class, 'destroy']);
    });

    Route::post('/logout', [UsersAuthentication::class, 'logout']);
});

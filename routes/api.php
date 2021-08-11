<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersAuthentication;
use App\Http\Controllers\VoucherController;
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
        Route::get('/admin/user/{user}', [UserController::class, 'show']);
        Route::put('/admin/user/{user}', [UserController::class, 'update']);
        Route::delete('admin/user/{user}', [UserController::class, 'destroy']);
    }); 

    Route::middleware(['role:gudang'])->group(function(){

        // manage product
        Route::get('/gudang/product', [ProductsController::class, 'index']);
        Route::post('/gudang/product', [ProductsController::class, 'store']);
        Route::get('/gudang/product/{product}', [ProductsController::class, 'show']);
        Route::put('/gudang/product/{product}', [ProductsController::class, 'update']);
        Route::delete('/gudang/product/{product}', [ProductsController::class, 'destroy']);

        // manage inventory
        Route::post('/gudang/product/{product}/inventory', [InventoryController::class, 'store']);
    });

    Route::middleware(['role:kasir'])->group(function(){
        // manage member
        Route::get('/kasir/member', [MemberController::class, 'index']);
        Route::post('/kasir/member', [MemberController::class, 'store']);
        Route::get('/kasir/member/{member}', [MemberController::class, 'show']);
        Route::put('/kasir/member/{member}', [MemberController::class, 'update']);
        Route::delete('/kasir/member/{member}', [MemberController::class, 'destroy']);

        // manage voucher
        Route::get('/kasir/voucher', [VoucherController::class, 'index']);
        Route::post('/kasir/voucher', [VoucherController::class, 'store']);
        Route::get('/kasir/voucher/{voucher}', [VoucherController::class, 'show']);
        Route::put('/kasir/voucher/{voucher}', [VoucherController::class, 'update']);
        Route::delete('/kasir/voucher/{voucher}', [VoucherController::class, 'destroy']);

        // Transaction 
        Route::get('/kasir/transaction/product/{product}', [TransactionController::class, 'showProduct']);
        Route::post('/kasir/transaction/member/{member}', [TransactionController::class, 'getMemberAndVoucher']);
        
        Route::post('/kasir/transaction/', [TransactionController::class, 'store']);
    });

    Route::post('/logout', [UsersAuthentication::class, 'logout']);
});

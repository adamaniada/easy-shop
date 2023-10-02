<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Auth\UpdateProfileController;
use App\Http\Controllers\Api\Auth\UpdatePasswordController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\v1\ProductsController;
use App\Http\Controllers\Api\v1\TransactionController;
use App\Http\Controllers\Api\v1\ShippingAddressController;
use App\Http\Controllers\Api\v1\CartsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Routes pour l'Authentification (non authentifiées)
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');

    // Routes nécessitant une authentification avec un token JWT
    Route::middleware('auth:api')->group(function () {
        Route::get('me', [AuthController::class, 'me'])->name('auth.me');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
        Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::apiResource('user/update-profile', UpdateProfileController::class)->only(['update']);
        Route::apiResource('user/update-password', UpdatePasswordController::class)->only(['update']);
        Route::apiResource('user/reset-password', ResetPasswordController::class)->only(['index', 'update']);
    });
});

Route::prefix('v1')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('products', ProductsController::class)->only(['index']);
        Route::apiResource('shipping-address', ShippingAddressController::class)->except(['create', 'show', 'edit']);
        Route::apiResource('carts', CartsController::class)->only(['index' ,'store', 'destroy']);
        Route::delete('carts/clear-all', [CartsController::class, 'clearAll'])->name('api.v1.cart.clearAll');
        Route::apiResource('transaction', TransactionController::class)->only(['index' ,'store']);
    });
});

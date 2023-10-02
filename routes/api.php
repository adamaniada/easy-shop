<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\v1\UsersController;
use App\Http\Controllers\Api\v1\CategoriesController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Routes pour l'Authentification (non authentifiées)
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');

    // Routes nécessitant une authentification avec un token JWT
    Route::middleware('auth:api')->group(function () {
        Route::get('me', [AuthController::class, 'me'])->name('auth.me');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
        Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::put('user/update-profile', [UsersController::class, 'updateProfile'])->name('auth.users.updateProfile');
        Route::put('user/update-password', [UsersController::class, 'updatePassword'])->name('auth.users.updatePassword');
        Route::put('user/disable-account', [UsersController::class, 'disableAccount'])->name('auth.users.disableAccount');
        Route::put('user/active-account', [UsersController::class, 'activeAccount'])->name('auth.users.activeAccount');
        Route::put('user/delete-account', [UsersController::class, 'deleteAccount'])->name('auth.users.deleteAccount');
    });
});

Route::prefix('v1')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('products', ProductsController::class)->except(['create', 'edit']);
        Route::get('shipping-address', [ShippingAddressController::class, 'getMyShippingAddress'])->name('api.v1.shipping-address');
        Route::post('shipping-address', [ShippingAddressController::class, 'store'])->name('api.v1.store');
        Route::put('shipping-address', [ShippingAddressController::class, 'update'])->name('api.v1.update');
        Route::apiResource('transaction', TransactionController::class)->except(['index' ,'create', 'edit' , 'update', 'destroy']);
        Route::apiResource('cart', CartsController::class)->except(['create', 'edit', 'update']);
    });
});

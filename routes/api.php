<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\v1\Auth\AuthenticatedController as AuthAuthenticatedController;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')
    ->name('api.')
    ->group(function () {
        Route::apiResource('users', UserController::class)->middleware('auth:sanctum');
        Route::post('/auth/register', [RegisterController::class, 'store'])->name('store');
        Route::post('/auth/login', [AuthAuthenticatedController::class, 'store'])->name('store');
});




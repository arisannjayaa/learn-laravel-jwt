<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
   Route::middleware('auth:api')->group(function () {
       Route::post('logout', [AuthController::class, 'logout']);
       Route::post('me', [AuthController::class, 'me']);
       Route::post('refresh', [AuthController::class, 'refresh']);
   });

   Route::post('register', [AuthController::class, 'register']);
   Route::post('login', [AuthController::class, 'login']);
});

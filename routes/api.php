<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware([\App\Http\Middleware\ApiAuthenticate::class]);

Route::post('/register', [\App\Http\Controllers\api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\api\AuthController::class, 'login']);

Route::middleware([\App\Http\Middleware\ApiAuthenticate::class])->group(function () {
    Route::post('/logout', [\App\Http\Controllers\api\AuthController::class, 'logout']);
    Route::get('/profile', [\App\Http\Controllers\api\AuthController::class, 'profile']);
});

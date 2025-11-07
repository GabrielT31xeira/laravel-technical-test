<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [\App\Http\Controllers\api\LoginController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\api\LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\api\LoginController::class, 'logout']);
    Route::get('/user', [\App\Http\Controllers\api\LoginController::class, 'profile']);
});

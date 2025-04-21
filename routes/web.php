<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiKeyController;

// show login & register forms
Route::get('login',    [AuthController::class,'showLogin'])->name('login');
Route::post('login',   [AuthController::class,'login']);
Route::get('register', [AuthController::class,'showRegister'])->name('register');
Route::post('register',[AuthController::class,'register']);

// protected routes
Route::middleware('auth')->group(function(){

    // ← give this route the name "dashboard"
    Route::get('dashboard', [ApiKeyController::class,'dashboard'])
         ->name('dashboard');

    // API key generation form on dashboard
    Route::post('api-key/generate', [ApiKeyController::class,'generate'])
         ->name('api.generate');

    // logout
    Route::post('logout', [AuthController::class,'logout'])
         ->name('logout');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckApiKey;

Route::middleware(['api', CheckApiKey::class])->group(function () {
    Route::apiResource('users', UserController::class)
         ->only(['index','store','show','update','destroy']);
});
Route::middleware(['api', CheckApiKey::class])->group(function(){
    // CRUD ya users...
    Route::post('users/login', [UserController::class,'login'])
         ->name('users.login');
});

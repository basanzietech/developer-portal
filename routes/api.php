<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckApiKey;
use App\Http\Controllers\UserController;

Route::middleware([CheckApiKey::class])->group(function(){
    Route::apiResource('users', App\Http\Controllers\UserController::class)
         ->only(['index','store','show','update','destroy']);
});
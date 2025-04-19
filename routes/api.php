<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('check.apikey')->group(function(){
    Route::apiResource('users', UserController::class)->only([
        'index','store','show','update','destroy'
    ]);
});
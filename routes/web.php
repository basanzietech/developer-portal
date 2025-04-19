<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiKeyController;

// SHOW LOGIN FORM
Route::get('/login', [AuthController::class,'showLogin'])->name('login');
// HANDLE LOGIN POST
Route::post('/login', [AuthController::class,'login']);

// SHOW REGISTER FORM
Route::get('/register', [AuthController::class,'showRegister'])->name('register');
// HANDLE REGISTER POST
Route::post('/register', [AuthController::class,'register']);

Route::middleware('auth')->group(function(){
    Route::get('dashboard', [ApiKeyController::class,'dashboard'])->name('dashboard');
    Route::post('api-key/generate', [ApiKeyController::class,'generate'])->name('api.generate');
    Route::post('logout', [AuthController::class,'logout'])->name('logout');
});

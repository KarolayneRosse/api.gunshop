<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\GunController;
use App\Http\Controllers\User\UserController;

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user/data', [UserController::class, 'userData']); //dados do user
});

Route::get('/gun', [GunController::class,'index']);
Route::get('/gun/{gun}', [GunController::class,'show']);

Route::post('/gun', [GunController::class,'store']);
Route::post('/gun/{gun}', [GunController::class,'update']);
Route::post('/gun/delete/{gun}', [GunController::class,'destroy']);

Route::post('/register',[UserController::class,'store']); //cadastrar user
Route::post('/login', [UserController::class, 'login']); //login
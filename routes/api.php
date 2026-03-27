<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->group(function () {

    Route::get('/user', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logOut'])->name('logout');

    Route::post('/missions',[MissionController::class, 'store']);

});



Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

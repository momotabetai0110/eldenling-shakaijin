<?php

use App\Http\Controllers\FirstLoginController;
use App\Http\Controllers\PlayGachaController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/test', [TestController::class, 'test']);
Route::post('/firstLogin', [FirstLoginController::class, 'login']);
Route::post('/playGacha', [PlayGachaController::class, 'play']);

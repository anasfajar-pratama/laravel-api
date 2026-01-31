<?php

use App\Http\Controllers\Api\BukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;

Route::apiResource('users', UserApiController::class);
Route::apiResource('bukus', BukuController::class);
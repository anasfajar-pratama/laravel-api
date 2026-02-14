<?php

use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\ProdukController;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;

Route::apiResource('users', UserApiController::class);
Route::apiResource('bukus', BukuController::class);
Route::apiResource('produks', ProdukController::class);
<?php
use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PelangganController;

use Illuminate\Http\Request;


Route::apiResource('users', UserApiController::class);
Route::apiResource('bukus', BukuController::class);
Route::apiResource('produks', ProdukController::class);
Route::post('/produks/{id}/images', [ProdukController::class, 'uploadImages']);
Route::apiResource('orders', OrdersController::class);
Route::put('orders/{id}/status',[OrdersController::class,'updateStatus']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/', function () {
    return 'API sukses';
});

// Pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index']);
Route::post('/pelanggan', [PelangganController::class, 'store']);
Route::get('/pelanggan/phone/{no_hp}', [PelangganController::class, 'findByPhone']);
Route::put('/pelanggan/{id}', [PelangganController::class, 'update']);
Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy']);

<?php
use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\PembelianController;
use App\Http\Controllers\Api\ProfilController;

use Illuminate\Http\Request;


Route::apiResource('users', UserApiController::class);
Route::apiResource('bukus', BukuController::class);
Route::apiResource('produks', ProdukController::class);
Route::post('/produks/{id}/images', [ProdukController::class, 'uploadImages']);
Route::apiResource('orders', OrdersController::class);
Route::put('orders/{id}/status', [OrdersController::class, 'updateStatus']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index']);
    Route::post('/pelanggan', [PelangganController::class, 'store']);
    Route::get('/pelanggan/phone/{no_hp}', [PelangganController::class, 'findByPhone']);
    Route::put('/pelanggan/{id}', [PelangganController::class, 'update']);
    Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy']);

    // Supplier
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::post('/suppliers', [SupplierController::class, 'store']);
    Route::get('/suppliers/{supplier}', [SupplierController::class, 'show']);
    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update']);
    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy']);

    // Pembelian
    Route::get('/pembelians', [PembelianController::class, 'index']);
    Route::post('/pembelians', [PembelianController::class, 'store']);
    Route::get('/pembelians/{pembelian}', [PembelianController::class, 'show']);
    Route::patch('/pembelians/{pembelian}/status', [PembelianController::class, 'updateStatus']);
    Route::delete('/pembelians/{pembelian}', [PembelianController::class, 'destroy']);

    // Profil
    Route::get('/profil', [ProfilController::class, 'show']);
    Route::put('/profil', [ProfilController::class, 'update']);
    Route::put('/profil/password', [ProfilController::class, 'updatePassword']);
    Route::post('/profil/foto', [ProfilController::class, 'uploadFoto']);
});

Route::get('/', function () {
    return 'API sukses';
});

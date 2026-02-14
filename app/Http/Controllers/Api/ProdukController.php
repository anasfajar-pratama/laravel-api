<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Resources\ProdukResource;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        
        $produk = Produk::paginate(10);
        
        return response()->json([
            'success' => true,
            'message' => 'List Produk',
            'data' => ProdukResource::collection($produk)
        ]);
    }
    
    public function store(Request $request)
    {
        $produk = Produk::create($request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dibuat',
            'data' => new ProdukResource($produk)
        ], 201);
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => new ProdukResource($produk)
        ]);

    }

    public function update(StoreProdukRequest $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Produk Berhasil Diupdate',
            'data' => new ProdukResource($produk)
        ]);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return response()->json([
            'success' => true,
            'message' => 'data berhasil dihapus'
        ]);
    }
}

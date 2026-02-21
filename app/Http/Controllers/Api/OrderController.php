<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use App\Models\Orders;
use App\Models\OrderItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        
        $orders = Orders::with('user', 'item.produk')->latest()->get();
        
        return new  OrderCollection($orders);
    }
    
    public function store(StoreOrderRequest $request)
    {

        DB::beginTransaction();

        $order = Orders::create($request->validated());
        
        try {
            
            $order = Orders::create([
                'user_id' => $request->user_id,
                'order_code' => 'ORD-'. time(),
                'total_price' => 0,
                'shipping_address' => $request->shipping_address,
                'status' => 'pending'
                ]);
                
                $total = 0;
                
                foreach ($request->items as $key => $value) {
                    # code...
                }
            }
    }

    public function show($id)
    {
        $order = Orders::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => new OrderResource($order)
        ]);

    }

    public function update(StoreOrderRequest $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'order Berhasil Diupdate',
            'data' => new OrderResource($order)
        ]);
    }

    public function destroy($id)
    {
        $order = Orders::findOrFail($id);
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'data berhasil dihapus'
        ]);
    }
}

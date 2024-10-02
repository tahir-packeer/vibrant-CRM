<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deliverer;
use App\Models\Order;
use Illuminate\Http\Request;

class DelivererMobileController extends Controller
{
    // Get order and deliverer details by order_id
    public function getOrderDeliverer($order_id)
    {
        $order = Order::with('product', 'user')->find($order_id);
        $deliverer = Deliverer::where('order_id', $order_id)->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        return response()->json([
            'success' => true,
            'order' => $order,
            'deliverer' => $deliverer
        ], 200);
    }
}

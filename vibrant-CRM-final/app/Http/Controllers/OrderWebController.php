<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderWebController extends Controller
{
    // Show all orders
    public function index()
    {
        // Fetch all orders with the product and user information
        $orders = Order::with('product', 'user')->get();

        return view('orders.index', compact('orders'));
    }

    // Show the form to edit an order (order status, payment status)
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    // Update the order status and payment status
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:Order Placed,Processing,Confirmed,Shipped,Delivered,Completed,Cancelled',
            'payment_status' => 'required|in:Pending,Paid,Failed'
        ]);

        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->payment_status = $request->payment_status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // Storing or updating an order
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_qty' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
            'user_name' => 'required|string',
            'user_address' => 'required|string',
            'payment_status' => 'required|in:Pending,Paid,Failed',
            'order_status' => 'required|in:Order Placed,Processing,Confirmed,Shipped,Delivered,Completed,Cancelled',
        ]);

        // Fetch the product to get the item_price
        $product = Product::findOrFail($request->product_id);

        // Calculate order_price
        $orderPrice = $product->item_price * $request->product_qty;

        // Create the order with the calculated order price
        $order = new Order();
        $order->product_id = $request->product_id;
        $order->product_qty = $request->product_qty;
        $order->user_id = $request->user_id;
        $order->user_name = $request->user_name;
        $order->user_address = $request->user_address;
        $order->payment_status = $request->payment_status;
        $order->order_status = $request->order_status;
        $order->order_price = $orderPrice; // Store calculated order price
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }
}

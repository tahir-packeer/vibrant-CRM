<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderMobileController extends Controller
{

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'product_id' => 'required|exists:products,id',
                'product_qty' => 'required|integer|min:1',
                'user_id' => 'required|exists:users,id',
                'user_name' => 'required|string',
                'user_address' => 'required|string',
                'payment_status' => 'required|in:Pending,Paid,Failed',
                'order_status' => 'required|in:Order Placed,Processing,Confirmed,Shipped,Delivered,Completed,Cancelled',
            ]);
            $product = Product::findOrFail($request->product_id);
            $orderPrice = $product->item_price * $request->product_qty;

            // Create new order
            $order = new Order();
            $order->product_id = $validatedData['product_id'];
            $order->product_qty = $validatedData['product_qty'];
            $order->user_id = $validatedData['user_id'];
            $order->user_name = $validatedData['user_name'];
            $order->user_address = $validatedData['user_address'];
            $order->payment_status = $validatedData['payment_status'];
            $order->order_status = $validatedData['order_status'];
            $order->order_price = $orderPrice;
            $order->save();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle cases where the model is not found
            return response()->json([
                'success' => false,
                'message' => 'Related record not found',
            ], 404);

        } catch (\Exception $e) {
            // Handle any other server errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getByUserId($userId)
    {
        $orders = Order::where('user_id', $userId)
            ->with('product') // Move this to correctly chain the method
            ->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user'], 404);
        }

        return response()->json($orders);
    }


    public function removeByCustomer($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Check if the order status is not in the specified array
        if (!in_array($order->order_status, ['Confirmed', 'Shipped', 'Delivered', 'Completed', 'Cancelled'])) {
            $order->delete();
            return response()->json(['message' => 'Order removed successfully']);
        }

        return response()->json(['message' => 'Order cannot be removed as it is already Confirmed'], 403);
    }


    public function Cartstore(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'products' => 'required|array|min:1',
                'products.*.product_id' => 'required|exists:products,id',
                'products.*.product_qty' => 'required|integer|min:1',
                'user_id' => 'required|exists:users,id',
                'user_name' => 'required|string',
                'user_address' => 'required|string',
                'payment_status' => 'required|in:Pending,Paid,Failed',
                'order_status' => 'required|in:Order Placed,Processing,Confirmed,Shipped,Delivered,Completed,Cancelled',
            ]);

            // Store the orders in a loop
            $orders = [];
            foreach ($validatedData['products'] as $productData) {
                // Find the product
                $product = Product::findOrFail($productData['product_id']);
                $orderPrice = $product->item_price * $productData['product_qty'];

                // Create new order
                $order = new Order();
                $order->product_id = $productData['product_id'];
                $order->product_qty = $productData['product_qty'];
                $order->user_id = $validatedData['user_id'];
                $order->user_name = $validatedData['user_name'];
                $order->user_address = $validatedData['user_address'];
                $order->payment_status = $validatedData['payment_status'];
                $order->order_status = $validatedData['order_status'];
                $order->order_price = $orderPrice;
                $order->save();

                // Store the created order in the array
                $orders[] = $order;

                // Find and delete the cart item for the user and product
                Cart::where('user_id', $validatedData['user_id'])
                    ->where('product_id', $productData['product_id'])
                    ->delete();
            }

            // Return success response with all created orders
            return response()->json([
                'success' => true,
                'message' => 'Orders created and cart items deleted successfully',
                'data' => $orders
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle cases where the model is not found
            return response()->json([
                'success' => false,
                'message' => 'Related record not found',
            ], 404);

        } catch (\Exception $e) {
            // Handle any other server errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




}

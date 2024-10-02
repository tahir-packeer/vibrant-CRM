<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'product_name' => 'required|string',
            'product_image' => 'required|string',
            'item_price' => 'required|numeric',
            'product_qty' => 'required|integer',
            'total_price' => 'required|numeric',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new cart entry
        $cart = Cart::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'product_image' => $request->product_image,
            'item_price' => $request->item_price,
            'product_qty' => $request->product_qty,
            'total_price' => $request->total_price,
        ]);

        return response()->json(['message' => 'Product added to cart successfully', 'cart' => $cart], 201);
    }

    public function getCartByUserId($user_id)
    {
        // Check if the user exists
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Fetch cart items associated with the user
        $cartItems = Cart::where('user_id', $user_id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'No items in cart'], 200);
        }

        return response()->json(['message' => 'Cart items retrieved successfully', 'cartItems' => $cartItems], 200);
    }

    public function deleteCartItem($cart_id)
    {
        // Find the cart item
        $cartItem = Cart::find($cart_id);

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        // Delete the cart item
        $cartItem->delete();

        return response()->json(['message' => 'Cart item deleted successfully'], 200);
    }

    public function updateProductQuantity(Request $request, $cart_id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'product_qty' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Find the cart item
        $cartItem = Cart::find($cart_id);

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        // Update the product quantity and recalculate the total price
        $cartItem->product_qty = $request->product_qty;
        $cartItem->total_price = $cartItem->item_price * $request->product_qty;

        // Save the updated cart item
        $cartItem->save();

        return response()->json(['message' => 'Cart item updated successfully', 'cartItem' => $cartItem], 200);
    }


}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductMobileController extends Controller
{
    // Get all products
    public function index()
    {
        // Retrieve all products with their category details
        $products = Product::with('category')->get();

        // Transform the products collection to include full image paths
        $products->transform(function($product) {
            $product->image = asset($product->image);  // Add full URL to the image
            return $product;
        });

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    // Get a specific product by ID
    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // Add full URL to the image
        $product->image = asset($product->image);

        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }
}

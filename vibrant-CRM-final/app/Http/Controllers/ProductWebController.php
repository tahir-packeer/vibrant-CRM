<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductWebController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'name' => 'required',
            'item_price' => 'required|numeric',
            'promotion_price' => 'nullable|numeric',
            'promotion_start' => 'nullable|date',
            'promotion_end' => 'nullable|date|after:promotion_start',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|boolean',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Find the category based on the provided category_id
        $category = Category::findOrFail($request->category_id);

        // Create a new product instance
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->item_price = $request->item_price;
        $product->promotion_price = $request->promotion_price;
        $product->promotion_start = $request->promotion_start;
        $product->promotion_end = $request->promotion_end;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->category_id = $category->id;
        $product->category_name = $category->name;

        // Handle the image upload if an image is provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'images/products/' . $filename;
            $file->move(public_path('images/products'), $filename);
            $product->image = $filePath;
        }

        // Save the product in the database
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {

        $category = Category::findOrFail($request->category_id);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->item_price = $request->item_price;
        $product->promotion_price = $request->promotion_price;
        $product->promotion_start = $request->promotion_start;
        $product->promotion_end = $request->promotion_end;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->category_name = $category->name;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'images/products/' . $filename;
            $file->move(public_path('images/products'), $filename);
            $product->image = $filePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

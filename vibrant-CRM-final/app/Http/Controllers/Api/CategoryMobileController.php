<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryMobileController extends Controller
{
    // Get all categories
    public function index()
    {
        $categories = Category::all();

        // Modify the image path so that it can be accessed by mobile app
        $categories->transform(function($category) {
            $category->image = asset($category->image);
            return $category;
        });

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    // Get a specific category by ID
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        // Modify the image path so that it can be accessed by mobile app
        $category->image = asset($category->image);

        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }
}

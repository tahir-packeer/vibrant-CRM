<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserMobileController extends Controller
{

    public function index()
    {
        // Fetch users with user_type 'customer' and 'admin'
        $customers = User::where('user_type', 'customer')->get();
        $admins = User::where('user_type', 'admin')->get();

        return view('users.index', compact('customers', 'admins'));
    }
    // Show user profile
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }

        return response()->json([
            'user' => $user
        ], 200);
    }

    // Update user profile
    public function update(Request $request, $id)
    {
        // Log the incoming request for debugging purposes
        Log::info('Update Request Data:', $request->all());

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'profile_image' => 'nullable|string' // Accept base64 image
        ]);

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }

        // Handle profile image if provided
        if ($request->has('profile_image')) {
            // Get the base64 encoded image
            $base64Image = $request->profile_image;

            // Decode the base64 string
            $imageData = base64_decode($base64Image);

            // Generate a unique file name
            $imageName = uniqid() . '.png';

            // Define the storage path for the image
            $imagePath = 'public/profile_images/' . $imageName;

            // Store the image using Laravel's Storage facade
            Storage::put($imagePath, $imageData);

            // Update the user's profile image path
            $user->profile_image = Storage::url($imagePath); // Returns public URL
        }

        // Update the user's name and email
        $user->name = $request->name;
        $user->email = $request->email;

        // Save the user
        $user->save();

        return response()->json([
            'message' => 'User updated successfully.',
            'user' => $user
        ], 200);
    }
}

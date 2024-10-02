<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class UserMobileController extends Controller
{
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

    public function update(Request $request, $id)
    {
        // Log the entire request data
        Log::info('Update Request Data:', $request->all());

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'profile_image' => 'nullable|string' // Allow profile_image to be optional
        ]);

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }
        if ($request->has('profile_image')) {
            // Get the base64 encoded image
            $base64Image = $request->profile_image;

            // Decode the base64 string
            $image = base64_decode($base64Image);

            // Generate a unique file name
            $imageName = uniqid() . '.png';

            // Define the path for the image inside public/images/profile_images
            $imagePath = public_path('images/profile_images/' . $imageName);

            // Create the directory if it doesn't exist
            if (!File::exists(public_path('images/profile_images'))) {
                File::makeDirectory(public_path('images/profile_images'), 0755, true);
            }
            file_put_contents($imagePath, $image);

            // Update the user's profile image path (relative to the public folder)
            $user->profile_image = '/images/profile_images/' . $imageName;
        }
        // Update the user's name and email
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return response()->json([
            'message' => 'User updated successfully.',
            'user' => $user
        ], 200);
    }
}

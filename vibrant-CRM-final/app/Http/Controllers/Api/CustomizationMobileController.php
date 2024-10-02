<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customization;
use Illuminate\Http\Request;

class CustomizationMobileController extends Controller
{
    // Store a new customization (Mobile API)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'nullable|numeric',
            'total_price' => 'nullable|numeric',
            'note' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        // Handle image upload
        $imagePath = null;
//        if ($request->hasFile('image')) {
//            $file = $request->file('image');
//            $filename = time() . '.' . $file->getClientOriginalExtension();
//            $imagePath = $file->storeAs('customizations', $filename, 'public');
//        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'images/customizations/' . $filename;
            $file->move(public_path('images/customizations'), $filename);
            $imagePath = $filePath;
        }

        // Create the customization
        $customization = Customization::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'quantity' => $request->quantity,
            'status' => 'Processing',
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
            'note' => $request->note,
            'user_id' => $request->user_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json([
            'success' => true,
            'data' => $customization,
        ], 201);
    }

    // Get customizations by user_id (Mobile API)
    public function getUserCustomizations($user_id)
    {
        $customizations = Customization::where('user_id', $user_id)->get();

        return response()->json([
            'success' => true,
            'data' => $customizations,
        ], 200);
    }

    public function getPendingPaymentCustomizations($user_id)
    {
        // Fetch customizations with status "Pending Payment" for the user
        $customizations = Customization::where('user_id', $user_id)
            ->where('status', 'Pending Payment')
            ->get();

        if ($customizations->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No pending payment customizations found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $customizations
        ], 200);
    }

    public function confirmPayment(Request $request, $id)
    {
        // Find the customization by ID
        $customization = Customization::findOrFail($id);

        // Check if the customization is currently in "Pending Payment" status
        if ($customization->status !== 'Pending Payment') {
            return response()->json([
                'success' => false,
                'message' => 'Customization is not in pending payment status.'
            ], 400);
        }

        // Update the status to "Confirm Payment"
        $customization->status = 'Confirm Payment';
        $customization->save();

        return response()->json([
            'success' => true,
            'message' => 'Payment confirmed successfully.',
            'data' => $customization
        ], 200);
    }

}

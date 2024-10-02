<?php

namespace App\Http\Controllers;

use App\Models\Customization;
use Illuminate\Http\Request;

class CustomizationWebController extends Controller
{
    // Show all customizations
    public function index()
    {
        // Fetch all customizations with images
        $customizations = Customization::all();
        return view('customizations.index', compact('customizations'));
    }

    // Show the form to edit customization details (status, unit_price, total_price)
    public function edit($id)
    {
        $customization = Customization::findOrFail($id);
        return view('customizations.edit', compact('customization'));
    }

    // Update the customization status, unit_price, total_price
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Processing,Pending Payment,Confirm Payment,Confirmed,Cancelled',
            'unit_price' => 'nullable|numeric|min:0',
            'total_price' => 'nullable|numeric|min:0',
        ]);

        $customization = Customization::findOrFail($id);
        $customization->status = $request->status;
        $customization->unit_price = $request->unit_price;
        $customization->total_price = $request->total_price;
        $customization->save();

        return redirect()->route('customizations.index')->with('success', 'Customization updated successfully.');
    }
}

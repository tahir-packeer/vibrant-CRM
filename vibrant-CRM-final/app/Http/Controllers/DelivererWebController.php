<?php

namespace App\Http\Controllers;

use App\Models\Deliverer;
use App\Models\Order;
use Illuminate\Http\Request;

class DelivererWebController extends Controller
{
    // Show all deliverers
    public function index()
    {
        // Fetch all deliverers with their associated orders
        $deliverers = Deliverer::with('order')->get();
        return view('deliverers.index', compact('deliverers'));
    }

    // Show the form to assign an order to a deliverer
    public function create()
    {
        // Get the list of orders that are not yet assigned to deliverers
        $unassignedOrders = Order::whereDoesntHave('deliverer')->get();

        return view('deliverers.create', compact('unassignedOrders'));
    }


    // Store a new deliverer
    public function store(Request $request)
    {
//        dd($request->order_id);
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'deliverer_name' => 'required|string|max:255',
            'delivery_status' => 'required|in:Pending,In Transit,Delivered,Canceled',
            'delivery_note' => 'nullable|string',
        ]);

        // Create a new deliverer record
        Deliverer::create([
            'order_id' => $request->order_id,
            'deliverer_name' => $request->deliverer_name,
            'delivery_status' => $request->delivery_status,
            'delivery_note' => $request->delivery_note,
        ]);

        return redirect()->route('deliverers.index')->with('success', 'Deliverer assigned successfully.');
    }

    // Show the form to edit delivery details
    public function edit($id)
    {
        $deliverer = Deliverer::findOrFail($id);
        return view('deliverers.edit', compact('deliverer'));
    }

    // Update delivery status and note
    public function update(Request $request, $id)
    {
        $request->validate([
            'delivery_status' => 'required|in:Pending,In Transit,Delivered,Canceled',
            'delivery_note' => 'nullable|string',
        ]);

        $deliverer = Deliverer::findOrFail($id);
        $deliverer->delivery_status = $request->delivery_status;
        $deliverer->delivery_note = $request->delivery_note;
        $deliverer->save();

        return redirect()->route('deliverers.index')->with('success', 'Delivery status updated successfully.');
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function create()
    {
        return view('forms.create-order'); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_item_no' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'postcode' => 'required|string|max:10',
            'delivery_date' => 'required|date',
            'delivery_start_time' => 'required|date_format:H:i',
            'delivery_end_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
            'status' => 'required|string|max:50',
        ]);

        $validatedData['created_by'] = Auth::id();

        Order::create($validatedData);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

   
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order')); 
    }

    
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'product_item_no' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'postcode' => 'required|string|max:10',
            'delivery_date' => 'required|date',
            'delivery_start_time' => 'required|date_format:H:i',
            'delivery_end_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
            'status' => 'required|string|max:50',
        ]);

        $validatedData['updated_by'] = Auth::id();

        $order->updateOrder($validatedData);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // Additional methods (index, show, destroy) can be added as needed
}

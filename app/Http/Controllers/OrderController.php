<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('order.view', compact('order'));
    }
    
    
    public function create()
    {
        return view('forms.create-order'); 
    }
    public function index()
    {
        // Fetch latest transactions (orders)
        $orders = Order::orderBy('created_at', 'desc')->take(10)->get();
        
        // Pass the orders to the view
        return view('admin.dashboard', compact('orders'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
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
            'order_status' => 'required|string|max:50',
        ]);

        try {
        
            $validatedData['created_by'] = Auth::id();
            Order::create($validatedData);

            return redirect()->route('admin.dashboard')->with('success', 'Order created successfully.');

        } catch (\Exception $e) {
        
            return redirect()->back()->withErrors(['error' => 'Failed to create the order. ' . $e->getMessage()]);
        }
    }



   
    public function edit(Order $order)
    {
        return view('forms.edit-order', compact('order')); 
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
            'order_status' => 'required|string|max:50',
        ]);
        
        $validatedData['updated_by'] = Auth::id();

        $order->updateOrder($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Order updated successfully.');
    }

    
}

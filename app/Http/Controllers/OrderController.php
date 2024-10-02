<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\Revenue;
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
        $revenu = Revenue::orderBy('created_at', 'desc')->take(10)->get();
        $totalRevenue = Revenue::totalRevenue();
        $pendingOrdersCount = Order::countPendingOrders();
        $CompletedOrdersCount = Order::countCompleteOrders();
        
        // Pass the orders to the view
        return view('admin.dashboard', compact('orders', 'revenu', 'totalRevenue', 'pendingOrdersCount', 'CompletedOrdersCount'));
    }
    public function singleindex()
    {
        
        $orders = Order::orderBy('created_at', 'desc')->take(10)->get();
        return view('order.index', compact('orders'));
    }
    public function pendingindex()
    {
       
        $orders = Order::where('order_status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('order.index', compact('orders'));
    }

    public function completedindex()
    {
        $orders = Order::where('order_status', 'Completed')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('order.index', compact('orders'));
    }
    public function refundindex()
    {
        $orders = Order::where('order_status', 'Refunded')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('order.index', compact('orders'));
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
            'payment_method' => 'string',      
            'payment_status' => 'string',
        ]);

        try {
        
            $validatedData['created_by'] = Auth::id();
            $validatedData['order_status'] = $request->input('order_status', 'pending');
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
            'delivery_start_time' => 'required',
            'delivery_end_time' => 'required',
            'price' => 'required|numeric',
            'order_status' => 'nullable|string|max:50',
            'payment_method' => 'nullable',      
            'payment_status' => 'nullable',
        ]);
        if ($validatedData['payment_status'] === 'Completed') {
            $validatedData['order_status'] = 'Completed';
        }
        if ($validatedData['payment_status'] === 'pending') {
            $validatedData['order_status'] = 'pending';
        }
        
        $validatedData['updated_by'] = Auth::id();

        $order->update($validatedData);
        if ($validatedData['payment_status'] === 'Completed') {
            Revenue::create([
                'amount' => $order->price,
                'source' => 'orders',
                'order_id' => $order->id,
            ]);
        }

        return redirect()->back()->with('success', 'Order updated successfully.');
    }
    public function refund(Request $request, Order $order)
    {
        // Check if the order is already refunded
        if ($order->order_status === 'refunded') {
            return redirect()->back()->with('error', 'Order has already been refunded.');
        }

        // Validate the request
        $validatedData = $request->validate([
            'order_status' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // Ensure that the price is negative (for refund)
        if ($validatedData['price'] > 0) {
            $validatedData['price'] = -1 * abs($validatedData['price']);
        }

        // Update the order status, price, and payment status
        $order->update([
            'order_status' => $validatedData['order_status'], // 'refunded'
            'price' => $validatedData['price'], // Negative price value
            'payment_status' => 'refund', // Automatically set payment status to refund
        ]);

        // Record the refund in the revenues table
        Revenue::create([
            'amount' => $validatedData['price'], // Negative value for refund
            'source' => 'orders refund',
            'order_id' => $order->id,
        ]);

        // Redirect or return with a success message
        return redirect()->back()->with('success', 'Order refunded successfully.');
    }



    
}

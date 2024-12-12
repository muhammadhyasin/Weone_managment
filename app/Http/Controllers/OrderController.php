<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\Pickup;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{ 
    // dashboard index   
    public function index(Request $request)
    {
        // Get filter and sorting parameters from the request
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $sortField = $request->query('sort_field', 'created_at');  // Default sort field is 'created_at'
        $sortOrder = $request->query('sort_order', 'desc');        // Default sort order is 'desc'

        // Default to first day of the current month and last day of the current month if no dates are provided
        if (!$startDate && !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString(); // 1st of the current month
            $endDate = Carbon::now()->endOfMonth()->toDateString();     // Last day of the current month
        }

        // Apply filtering conditions with the defined dates
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
                    ->orderBy($sortField, $sortOrder)
                    ->take(10)
                    ->get();

        $pickups = Pickup::whereBetween('created_at', [$startDate, $endDate])
                    ->orderBy($sortField, $sortOrder)
                    ->take(10)
                    ->get();

        $revenu = Revenue::whereBetween('created_at', [$startDate, $endDate])
                        ->orderBy($sortField, $sortOrder)
                        ->take(10)
                        ->get();

        // Filtered totals and counts
        $totalRevenue = Revenue::whereBetween('created_at', [$startDate, $endDate])->sum('amount');
        $pendingOrdersCount = Order::whereBetween('created_at', [$startDate, $endDate])
                                    ->where('order_status', 'pending')->count();
        $CompletedOrdersCount = Order::whereBetween('created_at', [$startDate, $endDate])
                                    ->where('order_status', 'completed')->count();
        $RefundedOrdersCount = Order::whereBetween('created_at', [$startDate, $endDate])
                                    ->where('order_status', 'refunded')->count();
        $CancelledOrdersCount = Order::whereBetween('created_at', [$startDate, $endDate])
                                    ->where('order_status', 'cancelled')->count();
        $totalExpenses = \App\Models\Expense::whereBetween('created_at', [$startDate, $endDate])->sum('amount');

        $pendingPickupsCount = Pickup::whereBetween('created_at', [$startDate, $endDate])
                                ->where('pickup_status', 'pending')->count();
        $CompletedPickupsCount = Pickup::whereBetween('created_at', [$startDate, $endDate])
                                ->where('pickup_status', 'completed')->count();

        // Pass the filtered and sorted data to the view
        return view('admin.dashboard', compact(
            'orders', 'revenu', 'totalRevenue', 'pendingOrdersCount', 'CompletedOrdersCount', 
            'totalExpenses', 'RefundedOrdersCount', 'CancelledOrdersCount', 'startDate', 'endDate', 'sortField', 'sortOrder','pendingPickupsCount', 
        'CompletedPickupsCount', 'pickups'
        ));
    }



   // show order  
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $logs = Log::where('order_id', $order->id)->with('user')->get();
        return view('order.view', compact('order', 'logs'));
    }
    public function createview()
    {
        return view('forms.create-order');
    }

    // create order

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
            'advance_amount' => 'nullable', 
            'description' => 'nullable',
        ]);

        try {
            // Set the creator ID and default order status
            $validatedData['created_by'] = Auth::id();
            $validatedData['order_status'] = $request->input('order_status', 'pending');

            // Create the order
            $order = Order::create($validatedData);

            // Log the order creation action
            try {
                // Log the order creation action
                Log::create([
                    'order_id' => $order->id, 
                    'user_id' => Auth::id(),
                    'action' => 'Created the order',
                ]);
            } catch (\Exception $e) {
                // If log creation fails, throw an error
                return redirect()->back()->withErrors(['error' => 'Order created, but failed to log the action. ' . $e->getMessage()]);
            }
    
            return redirect()->route('admin.dashboard')->with('success', 'Order created successfully.');
    
        } catch (\Exception $e) {
            // Handle order creation errors
            return redirect()->back()->withErrors(['error' => 'Failed to create the order. ' . $e->getMessage()]);
        }
    }

    // update order

    public function update(Request $request, Order $order)
    {
        // Store the old values for logging
        $oldValues = $order->getOriginal();

        // Validate the incoming request
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
            'advance_amount' => 'nullable', 
            'description' => 'nullable',
        ]);

        // Set order status based on payment status
        if ($validatedData['payment_status'] === 'Completed') {
            $validatedData['order_status'] = 'Completed';
        } elseif ($validatedData['payment_status'] === 'pending') {
            $validatedData['order_status'] = 'Pending';
        }

        $validatedData['updated_by'] = Auth::id();

        // Update the order
        $order->update($validatedData);

        // Log the changes made to the order
        $changes = [];
        foreach ($validatedData as $key => $value) {
            // Check if the value has changed
            if ($oldValues[$key] != $value) {
                $changes[$key] = [
                    'old' => $oldValues[$key],
                    'new' => $value,
                ];
            }
        }

        // Prepare the log action string in a readable format
        $actionParts = [];
        foreach ($changes as $field => $change) {
            $actionParts[] = ucfirst(str_replace('_', ' ', $field)) . ' changed from "' . $change['old'] . '" to "' . $change['new'] . '"';
        }
        $action = 'Updated : ' . implode(', ', $actionParts);

        // Create the log entry
        Log::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'action' => $action,
        ]);

        // Handle revenue creation if payment is completed
        if ($validatedData['payment_status'] === 'Completed') {
            Revenue::create([
                'amount' => $order->price,
                'source' => 'orders',
                'order_id' => $order->id,
            ]);
        }

        return redirect()->back()->with('success', 'Order updated successfully.');
    }

    // refund order

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

        // Store old values for logging
        $oldValues = $order->getOriginal();

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

        // Prepare the log action string in a readable format
        $action = 'Refunded order. Old status: "' . $oldValues['order_status'] . '" changed to: "' . $validatedData['order_status'] . '". Refund amount: "' . $validatedData['price'] . '".';

        // Create the log entry
        Log::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'action' => $action,
        ]);

        // Redirect or return with a success message
        return redirect()->back()->with('success', 'Order refunded successfully.');
    }


    public function invoice($id)
    {
        //invoice viewing
        $order = Order::findOrFail($id);
        return view('order.invoice', compact('order'));
    }
    public function create()
    {
        //create order view 
        return view('forms.create-order'); 
    }
    public function singleindex(Request $request)
    {
        // indexing all orders 
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $query = Order::query();

        
        if ($startDate && $endDate) {
            $query->whereBetween('delivery_date', [$startDate, $endDate]);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();
        return view('order.index', compact('orders'));
    }
    public function pendingindex()
    {
       // indexing pending orders 
        $orders = Order::where('order_status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('order.index', compact('orders'));
    }
    public function completedindex()
    {
        // indexing completed orders 
        $orders = Order::where('order_status', 'Completed')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('order.index', compact('orders'));
    }
    public function refundindex()
    {
        // refund index
        $orders = Order::where('order_status', 'Refunded')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('order.index', compact('orders'));
    }
    public function showOrderLogs($id)
    {
        // showing the logs of users
        $order = Order::findOrFail($id);
        $logs = Log::where('order_id', $order->id)->with('user')->get();
        
        return view('order.view', compact('order', 'logs'));
    }

    public function filterByDateRange(Request $request)
    {
        // Validate the incoming request to ensure proper date inputs
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Retrieve the validated dates
        $startDate = $validatedData['start_date'];
        $endDate = $validatedData['end_date'];

        // Query orders within the date range
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
                    ->orderBy('created_at', 'desc')
                    ->get();

        // Pass the orders to the view
        return view('order.index', compact('orders'));
    }


}

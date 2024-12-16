<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Revenue;
use App\Models\uLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    // public function index()
    // {
        
    //     $expenses = Expense::with('user')->get(); 
    //     return view('forms.expense-create', compact('expenses'));
    // }
    public function create()
    {
        //create order view 
        $expenses = Expense::with('user')->get(); 
        return view('forms.expense-create', compact('expenses')); 
    }
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'category' => 'required|string|in:diesel,cleaning supplies,maintenance,other',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        // Create the expense
        $expense = Expense::create([
            'category' => $validatedData['category'],
            'amount' => abs($validatedData['amount']),
            'description' => $validatedData['description'],
            'created_by' => Auth::id(),
        ]);
        uLog::record(
            "updated with data: " . json_encode($request->all())
        );

        // Log the expense as a negative value in the revenue table
        Revenue::create([
            'amount' => -abs($validatedData['amount']), // Store as negative value
            'source' => 'expenses',
            'order_id' => null, // Set to null as it's not related to an order
        ]);

        return redirect()->back()->with('success', 'Expense added successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupController extends Controller
{
    

    public function show($id)
    {
        $pickup = Pickup::findOrFail($id);
        $logs = Log::where('pickup_id', $pickup->id)->with('user')->get();

        return view('order.pickup-view', compact('pickup', 'logs'));
    }

    public function create()
    {
        return view('forms.create-pickup');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_item_no' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'pickup_address' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'postcode' => 'required|string|max:10',
            'pickup_date' => 'required|date',
            'pickup_start_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
            'pickup_status' => 'string|max:50',
            'description' => 'nullable',
        ]);

        $validatedData['created_by'] = Auth::id();
        $validatedData['pickup_status'] = $request->input('pickup_status', 'pending');

        $pickup = Pickup::create($validatedData);

        Log::create([
            'pickup_id' => $pickup->id,
            'user_id' => Auth::id(),
            'action' => 'Created the pickup',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Pickup created successfully.');
    }

    public function update(Request $request, Pickup $pickup)
    {
        $oldValues = $pickup->getOriginal();
        $validatedData = $request->validate([
            'product_item_no' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'pickup_address' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'postcode' => 'required|string|max:10',
            'pickup_date' => 'required|date',
            'pickup_start_time' => 'required',
            'price' => 'required|numeric',
            'pickup_status' => 'nullable|string|max:50',
            'description' => 'nullable',
        ]);

        $validatedData['updated_by'] = Auth::id();

        $validatedData['pickup_start_time'] = Carbon::parse($validatedData['pickup_start_time'])->format('H:i');

        $pickup->update($validatedData);

        $changes = [];
        foreach ($validatedData as $key => $value) {
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
        $action = 'Updated: ' . implode(', ', $actionParts);

        // Create the log entry
        Log::create([
            'pickup_id' => $pickup->id,
            'user_id' => Auth::id(),
            'action' => $action,
        ]);

        return redirect()->back()->with('success', 'Pickup updated successfully.');
    }


    public function filterByDateRange(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $pickups = Pickup::whereBetween('created_at', [$validatedData['start_date'], $validatedData['end_date']])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('pickup.index', compact('pickups'));
    }

    public function singleindex(Request $request)
    {
        // Indexing all pickups
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $query = Pickup::query();

        if ($startDate && $endDate) {
            $query->whereBetween('pickup_date', [$startDate, $endDate]);
        }

        $pickups = $query->orderBy('created_at', 'desc')->get();
        return view('pickup.index', compact('pickups'));
    }

    public function pendingindex()
    {
        // Indexing pending pickups
        $pickups = Pickup::where('pickup_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pickup.index', compact('pickups'));
    }

    public function completedindex()
    {
        // Indexing completed pickups
        $pickups = Pickup::where('pickup_status', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pickup.index', compact('pickups'));
    }

}
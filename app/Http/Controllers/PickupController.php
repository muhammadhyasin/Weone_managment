<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Pickup;
use App\Models\Log;
use App\Models\Revenue;
use App\Models\uLog;
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
            'pickup_address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:15',
            'postcode' => 'nullable|string|max:10',
            'pickup_date' => 'nullable|date',
            'pickup_start_time' => 'nullable|date_format:H:i',
            'pickup_end_time' => 'nullable|date_format:H:i',
            'price' => 'required|numeric',
            'pickup_status' => 'string|max:50',
            'description' => 'nullable',
        ]);

        $validatedData['created_by'] = Auth::id();
        $validatedData['pickup_status'] = $request->input('pickup_status', 'pending');

        $pickup = Pickup::create($validatedData);
        uLog::record(
            "updated with data: " . json_encode($request->all())
        );

       Log::record([
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
            'pickup_address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:15',
            'postcode' => 'nullable|string|max:10',
            'pickup_date' => 'nullable|date',
            'pickup_start_time' => 'required',
            'pickup_end_time' => 'nullable',
            'price' => 'required|numeric',
            'pickup_status' => 'nullable|string|max:50',
            'description' => 'nullable',
        ]);
    
        $validatedData['updated_by'] = Auth::id();
        $validatedData['pickup_start_time'] = Carbon::parse($validatedData['pickup_start_time'])->format('H:i');
    
        // Update pickup details
        $pickup->update($validatedData);
    
        // Check if the pickup status was updated to "Completed"
        if (
            $validatedData['pickup_status'] === 'Completed' &&
            $oldValues['pickup_status'] !== 'Completed'
        ) {
            // Add negative revenue for completed pickups
            Revenue::create([
                'amount' => -abs($pickup->price), // Ensure the amount is negative
                'source' => 'pickups',
                'pickup_id' => $pickup->id,
            ]);
            Expense::create([
                'category' => 'Pickup',
                'amount' => $pickup->price,
                'description' => 'Pickup for product item no: ' . $pickup->product_item_no,
                'pickup_id' => $pickup->id,
                'created_by' => Auth::id(),
            ]);
        }
    
        // Log the changes
        $changes = [];
        foreach ($validatedData as $key => $value) {
            if ($oldValues[$key] != $value) {
                $changes[$key] = [
                    'old' => $oldValues[$key],
                    'new' => $value,
                ];
            }
        }
    
        $actionParts = [];
        foreach ($changes as $field => $change) {
            $actionParts[] = ucfirst(str_replace('_', ' ', $field)) . ' changed from "' . $change['old'] . '" to "' . $change['new'] . '"';
        }
        $action = 'Updated: ' . implode(', ', $actionParts);
        uLog::record(
            "updated with data: " . json_encode($request->all())
        );
    
        Log::record([
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

    private function filterPickups(Request $request, $type = null)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $query = Pickup::query();

        // Apply date filtering
        if ($startDate) {
            if ($endDate && $startDate !== $endDate) {
                // Both start_date and end_date are provided and different
                $query->whereBetween('pickup_date', [$startDate, $endDate]);
            } else {
                // Either only start_date is provided or both dates are the same
                $query->whereDate('pickup_date', $startDate);
            }
        }

        // Apply type filtering
        if ($type) {
            $query->where('pickup_status', $type);
        }

        // Order by creation date
        return $query->orderBy('created_at', 'desc')->get();
    }

    public function singleindex(Request $request)
    {
        $pickups = $this->filterPickups($request);
        return view('pickup.index', compact('pickups'))->with('type', 'all');
    }

    public function pendingindex(Request $request)
    {
        $pickups = $this->filterPickups($request, 'pending');
        return view('pickup.index', compact('pickups'))->with('type', 'pending');
    }

    public function completedindex(Request $request)
    {
        $pickups = $this->filterPickups($request, 'completed');
        return view('pickup.index', compact('pickups'))->with('type', 'completed');
    }
    public function updatePickupStatus(Request $request, $id)
    {
        $request->validate([
            'pickup_status' => 'required|in:Completed,Pending',
        ]);

        $pickup = Pickup::findOrFail($id);
        $oldPickupStatus = $pickup->pickup_status;

        // Update the pickup status
        $pickup->pickup_status = $request->input('pickup_status');
        $pickup->save();

        // Remove the revenue record if status changes from Completed to Pending
        if ($oldPickupStatus === 'Completed' && $pickup->pickup_status === 'Pending') {
            Revenue::where('pickup_id', $pickup->id)->where('source', 'pickups')->delete();

            Log::record([
                'pickup_id' => $pickup->id,
                'user_id' => Auth::id(),
                'action' => "Updated pickup status from '{$oldPickupStatus}' to '{$pickup->pickup_status}' and Revenue record deleted.",
            ]);

            uLog::record(
                "Revenue record removed for pickup ID: {$pickup->id}, status changed back to Pending."
            );
        } else {
            Log::record([
                'pickup_id' => $pickup->id,
                'user_id' => Auth::id(),
                'action' => "Updated pickup status from '{$oldPickupStatus}' to '{$pickup->pickup_status}'.",
            ]);

            uLog::record(
                "Pickup status updated with data: " . json_encode($request->all())
            );
        }

        return redirect()->back()->with('status', 'Pickup status updated successfully!');
    }
}

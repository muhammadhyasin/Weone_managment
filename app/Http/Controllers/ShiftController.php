<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShiftController extends Controller
{
    public function index()
    {
        try {
            $shifts = Shift::all();
            return view('user.shift', compact('shifts'));
        } catch (\Exception $e) {
            Log::error('Error fetching shifts: ' . $e->getMessage());
            return redirect()->back()->withErrors('Error fetching shifts.');
        }
    }

    public function create()
    {
        return view('shifts.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i',
            ]);

            Shift::create($validatedData);

            return redirect()->route('shifts.index')->with('success', 'Shift created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating shift: ' . $e->getMessage());
            return redirect()->back()->withErrors('Error creating shift.');
        }
    }

    public function edit(Shift $shift)
    {
        try {
            return view('shifts.edit', compact('shift'));
        } catch (\Exception $e) {
            Log::error('Error editing shift ID ' . $shift->id . ': ' . $e->getMessage());
            return redirect()->back()->withErrors('Error editing shift.');
        }
    }

    public function update(Request $request, Shift $shift)
    {
        try {
            Log::info('Update method triggered for shift ID: ' . $shift->id);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'start_time' => 'required|',
                'end_time' => 'required|',
            ]);

            $shift->update($validatedData);

            return redirect()->route('shifts.index')->with('success', 'Shift updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating shift ID ' . $shift->id . ': ' . $e->getMessage());
            return redirect()->back()->withErrors('Error updating shift.');
        }
    }

    public function destroy(Shift $shift)
    {
        try {
            Log::info('Destroy method triggered for shift ID: ' . $shift->id);

            $shift->delete();

            return redirect()->route('shifts.index')->with('success', 'Shift deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting shift ID ' . $shift->id . ': ' . $e->getMessage());
            return redirect()->back()->withErrors('Error deleting shift.');
        }
    }
}

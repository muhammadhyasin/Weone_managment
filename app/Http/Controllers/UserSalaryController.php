<?php

namespace App\Http\Controllers;

use App\Models\UserSalary;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserSalaryController extends Controller
{

public function edit($id)
{
    Log::info("Editing user details for user ID: {$id}");

    try {
        // Fetch the user
        $user = User::findOrFail($id);
        Log::info("User found: ", $user->toArray());

        // Fetch or create a salary record for the user
        $userSalary = UserSalary::firstOrNew(['user_id' => $id]);
        Log::info("User salary details: ", $userSalary->toArray());

        // Pass both $user and $userSalary to the view
        return view('user.edit-user', compact('user', 'userSalary'));
    } catch (\Exception $e) {
        // Log the error
        Log::error("Error editing user ID: {$id}", ['error' => $e->getMessage()]);

        // Redirect back with an error message
        return redirect()->back()->with('error', 'Failed to load user details. Please try again.');
    }
}




    /**
     * Store or update salary and shift details.
     */
    public function storeOrUpdate(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'full_day_salary' => 'required|numeric|min:0',
            'half_day_salary' => 'required|numeric|min:0',
            'shift_start_hour' => 'required|integer|min:1|max:12',
            'shift_start_minute' => 'required|integer|min:0|max:59',
            'shift_start_ampm' => 'required|in:AM,PM',
            'shift_end_hour' => 'required|integer|min:1|max:12',
            'shift_end_minute' => 'required|integer|min:0|max:59',
            'shift_end_ampm' => 'required|in:AM,PM',
            'joining_date' => 'required|date',
        ]);

        // Combine start and end times
        $shiftStartTime = $validatedData['shift_start_hour'] . ':' . 
                          $validatedData['shift_start_minute'] . ' ' . 
                          $validatedData['shift_start_ampm'];

        $shiftEndTime = $validatedData['shift_end_hour'] . ':' . 
                        $validatedData['shift_end_minute'] . ' ' . 
                        $validatedData['shift_end_ampm'];

        // Parse and validate the times
        $startTime = Carbon::createFromFormat('h:i A', $shiftStartTime);
        $endTime = Carbon::createFromFormat('h:i A', $shiftEndTime);

        if ($endTime->lessThanOrEqualTo($startTime)) {
            return back()->withErrors(['shift_end_time' => 'End time must be after start time.']);
        }

        // Calculate working hours
        $workingHours = $startTime->diffInHours($endTime);

        // Update or create salary details
        UserSalary::updateOrCreate(
            ['user_id' => $userId],
            [
                'full_day_salary' => $validatedData['full_day_salary'],
                'half_day_salary' => $validatedData['half_day_salary'],
                'shift_start_time' => $startTime->format('h:i A'),
                'shift_end_time' => $endTime->format('h:i A'),
                'joining_date' => $validatedData['joining_date'],
            ]
        );

        return redirect()->route('user.salary.edit', $userId)->with('status', 'Salary and shift details updated successfully!');
    }
}

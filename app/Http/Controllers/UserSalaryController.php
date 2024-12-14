<?php

namespace App\Http\Controllers;

use App\Models\UserSalary;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserSalaryController extends Controller
{
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
        $shiftStartTimeString = sprintf(
            '%02d:%02d %s',
            $validatedData['shift_start_hour'],
            $validatedData['shift_start_minute'],
            $validatedData['shift_start_ampm']
        );

        $shiftEndTimeString = sprintf(
            '%02d:%02d %s',
            $validatedData['shift_end_hour'],
            $validatedData['shift_end_minute'],
            $validatedData['shift_end_ampm']
        );

        try {
            $startTime = Carbon::createFromFormat('h:i A', $shiftStartTimeString);
            $endTime = Carbon::createFromFormat('h:i A', $shiftEndTimeString);
        } catch (\Exception $e) {
            return back()->withErrors(['time_error' => 'Invalid time format.']);
        }

        if ($endTime->lessThanOrEqualTo($startTime)) {
            return back()->withErrors(['shift_end_time' => 'End time must be after start time.']);
        }

        UserSalary::updateOrCreate(
            ['user_id' => $userId],
            [
                'full_day_salary' => $validatedData['full_day_salary'],
                'half_day_salary' => $validatedData['half_day_salary'],
                'shift_start_time' => $startTime->format('H:i:s'),
                'shift_end_time' => $endTime->format('H:i:s'),
                'joining_date' => Carbon::parse($validatedData['joining_date'])->format('Y-m-d'),
            ]
        );

        return redirect()->back()->with('status', 'Salary updated successfully!');
    }
}

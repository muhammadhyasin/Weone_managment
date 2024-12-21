<?php

namespace App\Http\Controllers;

use App\Models\uLog;
use App\Models\UserSalary;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserSalaryController extends Controller
{
    public function storeOrUpdate(Request $request, $userId)
    {
        Log::info('Incoming Request:', $request->all());

        $validatedData = $request->validate([
            'full_day_salary' => 'required|numeric|min:0',
            'half_day_salary' => 'required|numeric|min:0',
            'shift_id' => 'required|exists:shifts,id',
            'joining_date' => 'required|date',
        ]);

        Log::info('Validation Passed:', $validatedData);

        try {
            $userSalary = UserSalary::updateOrCreate(
                ['user_id' => $userId],
                [
                    'full_day_salary' => $validatedData['full_day_salary'],
                    'half_day_salary' => $validatedData['half_day_salary'],
                    'shift_id' => $validatedData['shift_id'],
                    'joining_date' => Carbon::parse($validatedData['joining_date'])->format('Y-m-d'),
                ]
            );

            Log::info('UserSalary Updated:', $userSalary->toArray());

            return redirect()->back()->with('status', 'Salary updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating UserSalary:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withErrors(['error' => 'Failed to update salary.']);
        }
    }
}

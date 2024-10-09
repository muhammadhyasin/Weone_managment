<?php

namespace App\Http\Controllers;

use App\Models\UserSalary;
use App\Models\User; 
use Illuminate\Http\Request;

class UserSalaryController extends Controller
{

    public function index()
    {
        $salaries = UserSalary::with('user')->get(); 
        return view('user_salaries.index', compact('salaries'));
    }


    public function create()
    {
        $users = User::all(); 
        return view('user_salaries.create', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'full_day_salary' => 'required|numeric',
            'half_day_salary' => 'required|numeric',
            'shift_start_time' => 'required|date_format:H:i:s',
            'shift_end_time' => 'required|date_format:H:i:s',
            'joining_date' => 'required|date',
        ]);

        UserSalary::create($request->all()); 

        return redirect()->route('user_salaries.index')->with('success', 'Salary information saved successfully.');
    }


    public function edit(UserSalary $userSalary)
    {
        $users = User::all();
        return view('user_salaries.edit', compact('userSalary', 'users'));
    }


    public function update(Request $request, UserSalary $userSalary)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'full_day_salary' => 'required|numeric',
            'half_day_salary' => 'required|numeric',
            'shift_start_time' => 'required|date_format:H:i:s',
            'shift_end_time' => 'required|date_format:H:i:s',
            'joining_date' => 'required|date',
        ]);

        $userSalary->update($request->all()); 

        return redirect()->route('user_salaries.index')->with('success', 'Salary information updated successfully.');
    }


    public function destroy(UserSalary $userSalary)
    {
        $userSalary->delete();
        return redirect()->route('user_salaries.index')->with('success', 'Salary information deleted successfully.');
    }
}

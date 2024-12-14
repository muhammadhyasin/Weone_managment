<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.user', compact('users'));
    }
    public function create()
    {
        return view('user.create');
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if ($user->role == 'superadmin' && auth()->user()->role != 'superadmin') {
            return redirect()->back()->with('error', 'You are not authorized to edit a SuperAdmin.');
        }else{
            $user = User::findOrFail($id);
            $userSalary = UserSalary::firstOrNew(['user_id' => $id]);
            if ($userSalary->shift_start_time) {
                $shiftStart = Carbon::parse($userSalary->shift_start_time);
                $userSalary->shift_start_hour = $shiftStart->format('h');
                $userSalary->shift_start_minute = $shiftStart->format('i');
                $userSalary->shift_start_ampm = $shiftStart->format('A');
            }
        
            if ($userSalary->shift_end_time) {
                $shiftEnd = Carbon::parse($userSalary->shift_end_time);
                $userSalary->shift_end_hour = $shiftEnd->format('h');
                $userSalary->shift_end_minute = $shiftEnd->format('i');
                $userSalary->shift_end_ampm = $shiftEnd->format('A');
            }
            return view('user.edit-user', compact('user', 'userSalary'));
        }
        
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'user_status' => 'required|string|in:active,inactive',
        ]);

        $user->fill($validatedData);
        $user->save();
        return redirect()->back()->with('status', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);
        $user->password = bcrypt($validatedData['password']);
        $user->save();
        return redirect()->back()->with('status', 'Password updated successfully!');
    }

}

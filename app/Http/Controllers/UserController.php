<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\uLog;
use App\Models\User;
use App\Models\UserSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.user', compact('users'));
    }
    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('user.profile', compact('user'));
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
            $availableShifts = Shift::all();
            return view('user.edit-user', compact('user', 'userSalary', 'availableShifts'));
        }
        
    }
    public function update(Request $request, $id)
    {
        Log::info("Update method called for user ID: {$id}");
        $user = User::findOrFail($id);
        Log::info("User found: ", $user->toArray());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'user_status' => 'required|integer|in:0,1',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/users'), $filename);
            $user->profile_picture = 'images/users/' . $filename;
        }
        Log::info("Validated data: ", $validatedData);
        uLog::record(
            "updated with data: " . json_encode($request->all())
        );
        $validatedData['account_status'] = (int) $validatedData['user_status'];

        unset($validatedData['user_status']);
        $user->fill($validatedData);
        $user->save();
        Log::info("User updated successfully: ", $user->toArray());
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
        uLog::record(
            "updated with data: " . json_encode($request->all())
        );
        return redirect()->back()->with('status', 'Password updated successfully!');
    }

    public function updateLastSeen(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->last_seen = now();
            $user->save();
        }

        return response()->json(['success' => true]);
    }
}

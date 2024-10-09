<?php

namespace App\Http\Controllers;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Fetch authenticated user information
        $users = User::all(); // Adjust this based on how you're managing users

        return view('user.user', compact('users')); // Pass users data to the view
    }
    public function create()
    {
        // Fetch authenticated user information
         // Adjust this based on how you're managing users

        return view('user.create'); // Pass users data to the view
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit-user', compact('user'));
    }
    public function update(Request $request, $id)
    {
        // Retrieve the user by ID
        $user = User::findOrFail($id);

        // Validate the incoming request (you can define validation rules based on your requirements)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
            // Add any additional fields you want to validate, e.g., password
        ]);

        // Fill the user model with validated data
        $user->fill($validatedData);

        // If the email has changed, set email_verified_at to null
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save the updated user details
        $user->save();

        // Redirect back to the user list or the edit form with a success message
        return redirect()->route('user.index')->with('status', 'User updated successfully!');
    }


}

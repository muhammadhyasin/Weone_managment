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
}

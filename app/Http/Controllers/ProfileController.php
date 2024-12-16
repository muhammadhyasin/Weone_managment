<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function uploadProfilePicture(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        if (!$user) {
            Log::error('User not authenticated.');
            return response()->json(['success' => false, 'error' => 'User not authenticated'], 401);
        }

        try {
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');

                // Generate a unique file name
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('images/users', $filename, 'public'); // Store in 'public' disk

                // Update the user's profile picture path in the database
                $user->profile_picture = $path;
                $user->save();

                Log::info('Profile picture updated successfully for user: ' . $user->id);

                return response()->json(['success' => true, 'path' => $path]);
            } else {
                Log::error('No file uploaded.');
                return response()->json(['success' => false, 'error' => 'No file uploaded'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error uploading profile picture: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Something went wrong.'], 500);
        }
    }


}

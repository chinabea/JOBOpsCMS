<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception; 
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
    // Attempt to retrieve the user information from Google
    $googleUser = Socialite::driver('google')->user();

    session(['profilePictureUrl' => $googleUser->getAvatar()]);
    
    // Attempt to find the user in the local database by email
    $localUser = User::where('email', $googleUser->getEmail())->first();

    if ($localUser) {
        // Update the avatar if it's different
        if ($localUser->avatar !== $googleUser->getAvatar()) {
            $localUser->avatar = $googleUser->getAvatar();
            $localUser->save();
        }

        // Automatically log in the user and "remember" them
        Auth::login($localUser, true);
        
        if (is_null($localUser->expertise)) {
            return redirect()->route('user.setupProfile');
        } elseif ($localUser->expertise && !$localUser->is_approved) {
            return redirect()->route('account.pending');
        } 
        
        // Further role-based redirection
        if ($localUser->role == 1) {
            return redirect()->route('director.dashboard');
        } elseif ($localUser->role == 2) {
            return redirect()->route('unit-head.dashboard');
        } elseif ($localUser->role == 3) {
            return redirect()->route('mict-staff.dashboard');
        } elseif ($localUser->role == 4) {
            return redirect()->route('staff.dashboard');
        } else {
            return redirect()->route('staff.home');
        }
    } else {
        // If the user does not exist, create a new user in the database
        $newUser = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'avatar' => $googleUser->getAvatar(), // Save the avatar URL
            'is_approved' => false,
            'password' => '',  // No password needed as OAuth is used
        ]);

        // Log in the newly created user
        Auth::login($newUser, true);

        // Redirect to a not-approved page until an admin approves them
        // return redirect()->route('not-approved')->with('info', 'Your account is awaiting approval.');
        
        return redirect()->route('user.setupProfile');
    }
    } catch (Exception $e) {
        // Log the exception
        Log::error("Error during Google login: " . $e->getMessage());

        // Optionally, redirect to a custom error page or back with an error message
        return redirect('welcome')->with('error', 'Failed to log in with Google. Please try again.');
    }
}

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/');  // Redirect to home page or wherever you like
    }

    
}
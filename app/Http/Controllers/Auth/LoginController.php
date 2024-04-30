<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
{
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

        // Check if the user is approved
        if (!$localUser->is_approved) {
            return redirect()->route('not-approved');
        }
        
        // Further role-based redirection
        if ($localUser->role == '1') {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('mict-staff.home');
        }
    } else {
        // If the user does not exist, create a new user in the database
        $newUser = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(), // Save the avatar URL
            'is_approved' => false,
            'password' => '',  // No password needed as OAuth is used
        ]);

        // Log in the newly created user
        Auth::login($newUser, true);

        // Redirect to a not-approved page until an admin approves them
        return redirect()->route('not-approved')->with('info', 'Your account is awaiting approval.');
    }
}


    // public function handleGoogleCallback()
    // {
    //     // Attempt to retrieve the user information from Google
    //     $googleUser = Socialite::driver('google')->user();

    //     session(['profilePictureUrl' => $googleUser->getAvatar()]);
        
    //     // Attempt to find the user in the local database by email
    //     $localUser = User::where('email', $googleUser->getEmail())->first();
    
    //     // Check if the user exists in the local database
    //     if ($localUser) {
    //         // Automatically log in the user and "remember" them
    //         Auth::login($localUser, true);
    
    //         // Check if the user is approved
    //         if (!$localUser->is_approved) {
    //             // Redirect them to a "not approved" page
    //             return redirect()->route('not-approved');
    //         }
            
    //         // Further role-based redirection
    //         if ($localUser->role == '1') {
    //             // If the user is an admin
    //             return redirect()->route('admin.home');
    //         } else {
    //             // Default redirection for regular approved users
    //             return redirect()->route('mict-staff.home');
    //         }
    //     } else {
    //         // If the user does not exist, create a new user in the database
    //         $newUser = User::create([
    //             'name' => $googleUser->getName(),          // Assume you have a 'name' column
    //             'email' => $googleUser->getEmail(),        // Email from Google account
    //             'google_id' => $googleUser->getId(),       // Google ID to link account
    //             'is_approved' => false,                    // Newly created users are not approved by default
    //             'password' => '',                          // No password needed as OAuth is used
    //             // Add additional fields as required by your application
    //         ]);
    
    //         // Log in the newly created user
    //         Auth::login($newUser, true);
    
    //         // Redirect them to a not-approved page until an admin approves them
    //         return redirect()->route('not-approved')->with('info', 'Your account is awaiting approval.');
    //     }
    // }
    
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/');  // Redirect to home page or wherever you like
    }

    
}
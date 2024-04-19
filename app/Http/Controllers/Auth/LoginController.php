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
        
            $user = Socialite::driver('google')->user();
        
            $is_user = User::where('email', $user->getEmail())->first();

                
            if ($is_user) {
                Auth::login($is_user, true); // Login the user and "remember" the session
                // Check user role and redirect accordingly
                if ($is_user->role == '1') {
                    return redirect()->route('admin');
                }
            } else {
                return redirect()->route('staff');
            }
    }

    
}
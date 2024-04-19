<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Program;
use App\Models\Department;

class UserController extends Controller
{
    public function store(Request $request): RedirectResponse
    {   
        // Concatenate the provided email with a specific domain
        $email = $request->input('email') . '@cspc.edu.ph';
    
        // Check if a user with the same email already exists
        $existingUser = User::where('email', $email)->first();
    
        if ($existingUser) {
            // Handle the case where the email already exists
            // You can return an error message or redirect back with a message
            return redirect()->back()->with('error', 'Email address is already assigned.');
        }
    
        // If the email doesn't already exist, proceed to create a new user
        $input = $request->all();
        $input['email'] = $email;
        User::create($input);
    
        // Redirect to the specified URL with a success message
        return redirect('admin/users')->with('checked', 'User Added');
    }
    
}

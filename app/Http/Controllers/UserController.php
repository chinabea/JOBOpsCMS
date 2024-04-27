<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    // Method to approve a user
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();
    
        // Log activity
        ActivityLogger::log('Approved', $user, 'User approved');

        return redirect()->route('users')->with('success', 'User has been approved.');
    }

    // Method to disapprove a user
    public function disapprove($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = false;
        $user->save();
    
        // Log activity
        ActivityLogger::log('Disapproved', $user, 'User disapproved');

        return redirect()->route('users')->with('success', 'User approval has been revoked.');
    }

    public function index()
    {
        try {
            // Fetch all records from the model and pass them to the view
            $users = User::orderBy('created_at', 'ASC')->get();
            // return redirect()->route('users', compact('users'));
            return view('user.index', compact('users'));

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // public function edit($id)
    // {
    //     $user = User::find($id); // Fetch the user by id
    
    //     // Define expertise options
    //     $expertiseOptions = ['Software Development', 'Project Management', 'Graphic Design', 'Data Analysis'];
    //             $roles = [1 => 'Admin', 2 => 'MICT Staff', 3 => 'Staff']; 
    
    //     // Ensure to pass the expertiseOptions to the view along with other data
    //     return view('user.user-profile', [
    //         'user' => $user,
    //         'expertiseOptions' => $expertiseOptions,
    //          'roles' => $roles
    //     ]);
    // }
    

    public function edit($id)
    {
        try {
            // Retrieve and show the specific item for editing
            $user = User::findOrFail($id);
        
            // Here, we define the roles. In a real application, consider retrieving these from a config or database.
            $roles = [1 => 'Admin', 2 => 'MICT Staff', 3 => 'Staff']; 
            
            return view('user.user-profile', compact('user', 'roles'));
        } catch (Exception $e) {
            // Handle the exception here, you can log it or return an error response
            return $e->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate and update the item with the provided ID
            $user = User::findOrFail($id);
            // Update the item properties using the request data
            $user->update($request->all());
    
            // Log activity
            ActivityLogger::log('Updated', $user, 'User updated');

            // Redirect to the index or show view, or perform other actions
            return redirect()->route('users')->with('success', 'User Successfully Updated!');
        } catch (Exception $e) {
            // Handle the exception here, you can log it or return an error response
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            // Delete the item with the provided ID
            $user = User::findOrFail($id);
            $user->delete();
    
            // Log activity
            ActivityLogger::log('Deleted', $user, 'User deleted');

            // Redirect to the index or perform other actions
            return redirect()->route('users')->with('success', 'User Successfully Deleted!');
        } catch (Exception $e) {
            // Handle the exception here, you can log it or return an error response
            return $e->getMessage();
        }
    }
}

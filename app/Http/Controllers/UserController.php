<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Ticket;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    
    public function edit($id)
    {
        try {
            // Retrieve and show the specific item for editing
            $user = User::findOrFail($id);
        
            // Here, we define the roles. In a real application, consider retrieving these from a config or database.
            $roles = [1 => 'Admin', 2 => 'MICT Staff', 3 => 'Staff']; 
    
            // Define the expertise options
            $expertiseOptions = ['Web Development', 'Graphic Design', 'Data Analysis', 'Project Management'];
            
            // Convert the comma-separated string of expertise to an array
            $user->expertise = explode(',', $user->expertise);
            
            $userId = auth()->id();
        
            // Fetch tickets where the user is assigned
            $assignedTickets = Ticket::whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->with('user', 'users') // Load relationships
            ->orderBy('created_at', 'desc')
            ->get();
        
            // Example of existing expertise assuming it's stored as an array or collection
            $existingExpertise = $user->expertise; // Ensure this is defined in your User model

           
            $userId = auth()->id(); // Ensures we're getting data for the logged-in user

            $monthlyTicketsData = Ticket::select(DB::raw("YEAR(created_at) as year"), DB::raw("MONTH(created_at) as month"), DB::raw("COUNT(*) as count"))
                ->where('user_id', $userId)
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();

                    
            return view('user.user-profile', compact('user', 'roles', 'expertiseOptions', 'assignedTickets',
             'existingExpertise','monthlyTicketsData'));
        } catch (Exception $e) {
            // Handle the exception here, you can log it or return an error response
            return $e->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->expertise = implode(',', $request->expertise); // Convert array to comma-separated string, if storing as string
            $user->save();
    
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

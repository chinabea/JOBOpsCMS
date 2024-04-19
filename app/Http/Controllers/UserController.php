<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
            return view('user.edit', compact('user'));
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

            // Redirect to the index or perform other actions
            return redirect()->route('users')->with('success', 'User Successfully Deleted!');
        } catch (Exception $e) {
            // Handle the exception here, you can log it or return an error response
            return $e->getMessage();
        }
    }
}

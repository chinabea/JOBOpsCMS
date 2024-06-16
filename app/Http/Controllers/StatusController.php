<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class StatusController extends Controller
{

    public function purchaseParts()
    {
        try {
            $tickets = Ticket::where('status', 'Purchase Parts')->orderBy('created_at', 'desc')->get();
            $userIds = User::where('is_approved', true)->get(); 

            return view('status.purchase-parts', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function completed()
    {
        try {
            $tickets = Ticket::where('status', 'Completed')->orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get(); 

            return view('status.completed', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function open()
    {
        try {
            $tickets = Ticket::where('status', 'Open')->orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get(); 

            return view('status.open', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function inProgress()
    {
        try {
            $tickets = Ticket::where('status', 'In Progress')->orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get(); 

            return view('status.in-progress', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function closed()
    {
        try {
            $tickets = Ticket::where('status', 'Closed')->orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get(); 

            return view('status.closed', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

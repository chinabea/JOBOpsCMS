<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class StatusController extends Controller
{

    public function open()
    {
        try {
            $tickets = Ticket::where('status', 'Open')->orderBy('created_at', 'desc')->get();

            return view('status.open', compact('tickets'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function inProgress()
    {
        try {
            $tickets = Ticket::where('status', 'In Progress')->orderBy('created_at', 'desc')->get();

            return view('status.in-progress', compact('tickets'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function closed()
    {
        try {
            $tickets = Ticket::where('status', 'Closed')->orderBy('created_at', 'desc')->get();

            return view('status.closed', compact('tickets'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

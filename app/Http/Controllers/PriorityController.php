<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class PriorityController extends Controller
{

    public function high()
    {
        try {
            $tickets = Ticket::where('priority_level', 'High')->get();

            return view('priority-level.high', compact('tickets'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mid()
    {
        try {
            $tickets = Ticket::where('priority_level', 'Mid')->get();

            return view('priority-level.mid', compact('tickets'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function low()
    {
        try {
            $tickets = Ticket::where('priority_level', 'Low')->get();

            return view('priority-level.low', compact('tickets'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

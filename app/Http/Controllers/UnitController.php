<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    // Display the form for creating a new unit type
    public function create()
    {
        return view('unit.create');  // Make sure to create this view
    }

    // Store a new unit type in the database
    public function store(Request $request)
    {

        $unitType = new Unit();
        $unitType->name = $request->name;
        $unitType->save();

        return redirect()->route('units.create')->with('success', 'Unit type added successfully!');
    }
    
}

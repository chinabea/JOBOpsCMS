<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('unit.create', compact('units'));
    }

    // public function create()
    // {
    //     $units = Unit::all();
    //     return view('unit.create', compact('units'));
    // }
    public function create()
    {
        $unit = new Unit(); // Create a new Unit instance
        $units = Unit::all();
        return view('unit.create', compact('units', 'unit'));
    }


    public function store(Request $request)
    {
        $unit = Unit::create($request->all());
        
        return redirect()->route('units.create')->with('success', 'Unit Successfully Added!');
            
    }
    
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->update($request->all());
        return redirect()->route('units.index')->with('success', 'Unit updated successfully');
    }

    
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Unit deleted successfully');
    }
}

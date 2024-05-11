<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('unit.create');
    }

    public function store(Request $request)
    {
        try {
            
            $unit = Unit::create($request->all());
            
            return redirect()->route('units.create')->with('success', 'Unit Successfully Added!');
        } catch (Exception $e) {
            
            return $e->getMessage();
        }
    }

    
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('units.edit', compact('unit'));
    }
    
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Unit deleted successfully');
    }
}

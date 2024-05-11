<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictram;
use App\Models\Unit;

class IctramController extends Controller
{
    public function index()
    {
        $ictrams = Ictram::all();
        return view('ictrams.index', compact('ictrams'));
    }

    public function create()
    {
        $units = Unit::all();
        return view('unit.ictram.create', compact('units'));
    }

    public function store(Request $request)
    {
        try {
            
        // Retrieve the unit_id from the request
        $unitId = $request->input('unit_id');

        // Create a new Ictram record with the submitted data
        $ictram = Ictram::create([
            'unit_id' => $unitId,
            'jobtype' => $request->input('jobtype'),
            'equipment' => $request->input('equipment'),
            'problem' => $request->input('problem'),
            'is_warrantry' => $request->has('is_warrantry'), // Convert checkbox value to boolean
        ]);

            return redirect()->route('units.create')->with('success', 'ICTRAM Successfully Added!');
        } catch (Exception $e) {
            
            return $e->getMessage();
        }
    }
    public function edit($id)
    {
        $ictram = Ictram::findOrFail($id);
        return view('ictrams.edit', compact('ictram'));
    }
    
    public function destroy($id)
    {
        $ictram = Ictram::findOrFail($id);
        $ictram->delete();
        return redirect()->route('ictrams.index')->with('success', 'ICTRAM deleted successfully');
    }
}

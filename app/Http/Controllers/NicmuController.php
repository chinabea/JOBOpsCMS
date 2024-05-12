<?php

namespace App\Http\Controllers;

use App\Models\Nicmu;
use Illuminate\Http\Request;

class NicmuController extends Controller
{
    public function index()
    {
        $nicmus = Nicmu::all();
        return view('nicmus.index', compact('nicmus'));
    }

    public function create()
    {
        return view('unit.nicmu.create');
    }
    
    public function store(Request $request)
    {
        try {
            // Set a default value for unit if it's not submitted with the form data
            $unit = $request->input('unit', 'NICMU-Network Internet and Communications Management Unit');
            
            // Create a new Ictram record with the submitted data
            $nicmu = Nicmu::create([
                'unit' => $unit,
                'jobtype' => $request->input('jobtype'),
                'equipment' => $request->input('equipment'),
            ]);
    
            return redirect()->route('nicmus.create')->with('success', 'NICMU  Successfully Added!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function edit($id)
    {
        $nicmu = Nicmu::findOrFail($id);
        return view('nicmus.edit', compact('nicmu'));
    }
    
    public function destroy($id)
    {
        $nicmu = Nicmu::findOrFail($id);
        $nicmu->delete();
        return redirect()->route('nicmus.index')->with('success', 'NICMU deleted successfully');
    }
}

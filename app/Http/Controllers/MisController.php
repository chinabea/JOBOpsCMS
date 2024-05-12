<?php

namespace App\Http\Controllers;

use App\Models\Mis;
use App\Models\Unit;
use Illuminate\Http\Request;

class MisController extends Controller
{
    public function index()
    {
        $mises = Mis::all();
        return view('mises.index', compact('mises'));
    }

    public function create()
    {
        $units = Unit::all();
        return view('unit.mis.create', compact('units'));
    }
    
    public function store(Request $request)
    {
        try {
            // Set a default value for unit if it's not submitted with the form data
            $unit = $request->input('unit', 'MIS-Management Information System');
    
            // Create a new Ictram record with the submitted data
            $mis = Mis::create([
                'unit' => $unit,
                'jobtype' => $request->input('jobtype'),
                'requesttype' => $request->input('requesttype'),
                'asname' => $request->input('asname'),
            ]);
    
            return redirect()->route('mises.create')->with('success', 'ICTRAM Successfully Added!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        $mis = Mis::findOrFail($id);
        return view('mises.edit', compact('mis'));
    }
    public function destroy($id)
    {
        $mis = Mis::findOrFail($id);
        $mis->delete();
        return redirect()->route('mises.index')->with('success', 'MIS deleted successfully');
    }
}

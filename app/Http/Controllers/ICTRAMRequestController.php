<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IctramRequest;

class ICTRAMRequestController extends Controller
{
    
    public function index()
    {
        $ictrams = IctramRequest::all();
        return view('units.ictram.index', compact('ictrams'));
    }

    public function create()
    {
        return view('units.ictram.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ictram_job_type_id' => 'required|exists:ictram_job_types,id',
            'ictram_equipment_id' => 'required|exists:ictram_equipments,id',
            'ictram_problem_id' => 'required|exists:ictram_problems,id',
        ]);

        IctramRequest::create($validatedData);

        return redirect()->route('units.ictram.index')->with('success', 'Request created successfully!');
    }

    public function show($id)
    {
        $request = IctramRequest::findOrFail($id);
        return view('units.ictram.show', compact('request'));
    }

    public function edit($id)
    {
        $request = IctramRequest::findOrFail($id);
        return view('units.ictram.edit', compact('request'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ictram_job_type_id' => 'required|exists:ictram_job_types,id',
            'ictram_equipment_id' => 'required|exists:ictram_equipments,id',
            'ictram_problem_id' => 'required|exists:ictram_problems,id',
        ]);

        $request = IctramRequest::findOrFail($id);
        $request->update($validatedData);

        return redirect()->route('units.ictram.index')->with('success', 'Request updated successfully!');
    }

    public function destroy($id)
    {
        $request = IctramRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('units.ictram.index')->with('success', 'Request deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\OfficeName;
use Illuminate\Http\Request;

class OfficeNameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $officeNames = OfficeName::all();
        return view('office_names.index', compact('officeNames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('office_names.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'office_name' => 'required|string|max:255',
        ]);

        OfficeName::create($request->all());

        return redirect()->route('office-names.index')
                         ->with('success', 'Office Name created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OfficeName $officeName)
    {
        return view('office_names.show', compact('officeName'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OfficeName $officeName)
    {
        return view('office_names.edit', compact('officeName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OfficeName $officeName)
    {
        $request->validate([
            'office_name' => 'required|string|max:255',
        ]);

        $officeName->update($request->all());

        return redirect()->route('office-names.index')
                         ->with('success', 'Office Name updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OfficeName $officeName)
    {
        $officeName->delete();

        return redirect()->route('office-names.index')
                         ->with('success', 'Office Name deleted successfully.');
    }
}

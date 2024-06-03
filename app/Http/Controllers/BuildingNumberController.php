<?php

namespace App\Http\Controllers;

use App\Models\BuildingNumber;
use Illuminate\Http\Request;

class BuildingNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildingNumbers = BuildingNumber::all();
        return view('building_numbers.index', compact('buildingNumbers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('building_numbers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'building_number' => 'required|string|max:255',
        ]);
    
        // Exclude the _token field from the request data
        $data = $request->except('_token');
    
        BuildingNumber::create($data);
    
        return redirect()->route('building-numbers.index')
                         ->with('success', 'Building Number created successfully.');
                         
    }

    /**
     * Display the specified resource.
     */
    public function show(BuildingNumber $buildingNumber)
    {
        return view('building_numbers.show', compact('buildingNumber'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BuildingNumber $buildingNumber)
    {
        return view('building_numbers.edit', compact('buildingNumber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BuildingNumber $buildingNumber)
    {
        $request->validate([
            'building_number' => 'required|string|max:255',
        ]);

        $buildingNumber->update($request->all());

        return redirect()->route('building-numbers.index')
                         ->with('success', 'Building Number updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BuildingNumber $buildingNumber)
    {
        $buildingNumber->delete();

        return redirect()->route('building-numbers.index')
                         ->with('success', 'Building Number deleted successfully.');
    }
}

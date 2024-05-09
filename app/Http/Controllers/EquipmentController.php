<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquipmentType;

class EquipmentController extends Controller
{
    // Display the form for creating a new unit type
    public function create()
    {
        return view('equipment.create');  // Make sure to create this view
    }

    // Store a new unit type in the database
    public function store(Request $request)
    {

        $equipmentType = new EquipmentType();
        $equipmentType->name = $request->name;
        $equipmentType->save();

        return redirect()->route('equipments.create')->with('success', 'Equipment type added successfully!');
    }
}

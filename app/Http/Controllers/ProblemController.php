<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProblemTypeOrEquipment;
use App\Models\JobType;

class ProblemController extends Controller
{
    // Display the form for creating a new unit type
    public function create()
    {
        $jobTypes = JobType::all(); 
        return view('problemOrEquipment.create', compact('jobTypes'));
    }

    // Store a new unit type in the database
    public function store(Request $request)
    {
        // $request->validate([
        //     'job_type_id' => 'required|exists:jobTypes,id', // Ensure the unit exists
        //     'name' => 'required|string|max:255' // Validation for job type name
        // ]);
        $problemTypeOrEquipment = new ProblemTypeOrEquipment();
        $problemTypeOrEquipment->job_type_id = $request->job_type_id;
        $problemTypeOrEquipment->name = $request->name;
        $problemTypeOrEquipment->save();

        return redirect()->route('problemOrEquipments.create')->with('success', 'Unit type added successfully!');
    }
    
    public function getEquipmentTypesByJob($jobId)
    {
        $equipmentTypes = Equipment::where('job_id', $jobId)->get();
        return response()->json($equipmentTypes);
    }
}

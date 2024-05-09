<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobType;
use App\Models\Unit;

class JobController extends Controller
{
    public function create()
    {
        $units = Unit::all();  // Fetch all units to select from in the view
        return view('job.create', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id', // Ensure the unit exists
            'name' => 'required|string|max:255' // Validation for job type name
        ]);

        $jobType = new JobType();
        $jobType->unit_id = $request->unit_id;
        $jobType->name = $request->name;
        $jobType->save();

        return redirect()->route('jobs.create')->with('success', 'Job Type successfully added!');
    }
    
    public function getJobTypesByUnit($unitId)
    {
        $jobTypes = JobType::where('unit_id', $unitId)->get();
        return response()->json($jobTypes);
    }
    
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictram;
use App\Models\IctramJobType;
use App\Models\IctramEquipment;
use App\Models\IctramProblem;

class ICTRAMController extends Controller
{
    
    public function index()
    {
        $ictrams = Ictram::all();
        $jobTypes = IctramJobType::all();
        $equipments = IctramEquipment::all();
        $problems = IctramProblem::all();

        
        $ictrams = Ictram::with('jobTypes.equipments.problems')->get();
        
        // return view('units.ictram.index', compact('ictrams'));
        
        return view('units.ictram.index', compact('ictrams', 'jobTypes', 'equipments', 'problems'));
    }

    // Display the form
    public function create()
    {
        $jobTypes = IctramJobType::all();
        return view('units.ictram.index', compact('jobTypes'));
    }

    // Handle form submission
    public function storeJobType(Request $request)
    {
        
        $jobType = IctramJobType::create($request->all());

        return redirect()->route('ictrams.index')->with('success', 'ICTRAM Job Type created successfully.');
    }
    
    // Handle form submission
    public function storeEquipment(Request $request)
    {
        $ictram = IctramEquipment::create($request->all());

        return redirect()->route('ictrams.index')->with('success', 'ICTRAM Request created successfully.');
    }
    
    // Handle form submission
    public function storeProblem(Request $request)
    {

        $equipments = IctramEquipment::all();
        $problem = IctramProblem::create([
            'ictram_equipment_id' => $request->input('ictram_equipment_id'),
            'problem_description' => $request->input('problem_description'),
        ]);

        return redirect()->route('ictrams.index', compact('equipments'));
    }


    public function edit($id)
    {
        $ictram = Ictram::findOrFail($id);
        return view('ictrams.edit', compact('ictram'));
    }

    public function show($id)
    {
        $ictram = Ictram::findOrFail($id);
        return view('ictrams.index', compact('ictram'));
    }

    public function destroy($id)
    {
        $ictram = Ictram::findOrFail($id);
        $ictram->delete();
        return redirect()->route('ictrams.index')->with('success', 'ICTRAM deleted successfully');
    }

    
    public function getEquipmentsByJobType($jobType)
    {
        // Fetch equipment options based on the selected job type
        $equipments = IctramEquipment::where('job_type_id', $jobType)->get();

        // Construct HTML options for the equipment dropdown
        $options = '';
        foreach ($equipments as $equipment) {
            $options .= '<option value="' . $equipment->id . '">' . $equipment->equipment_name . '</option>';
        }

        // Return the HTML options
        return $options;
    }
}

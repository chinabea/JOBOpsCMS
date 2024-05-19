<?php

namespace App\Http\Controllers;

use App\Models\Nicmu;
use Illuminate\Http\Request;
use App\Models\NicmuJobType;
use App\Models\NicmuEquipment;
use App\Models\NicmuProblem;

class NicmuController extends Controller
{
    public function index()
    {
        $nicmus = Nicmu::with(['jobType', 'equipment', 'problem'])->get();
        $jobTypes = NicmuJobType::all();
        $equipments = NicmuEquipment::all();
        $problems = NicmuProblem::all();
        $sortedNicmus = $nicmus->sortBy('jobType.jobType_name');

        
        return view('units.nicmu.index', compact('nicmus', 'jobTypes', 'equipments', 'problems', 'sortedNicmus'));
    }

        public function storeWithRelationShip(Request $request)
    {   
            $validator = Validator::make($request->all(), [
                'nicmus_job_type_id' => 'required',
                'nicmus_equipment_id' => 'required',
                'nicmus_problem_id' => 'required',
                'nicmus_job_type_id' => 'unique:nicmus,nicmus_job_type_id,NULL,id,nicmus_equipment_id,' . $request->input('nicmus_equipment_id') . ',ictram_problem_id,' . $request->input('ictram_problem_id'),
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('success', 'The data you choose is existing.');
            }

            Nicmu::create([
                'nicmu_job_type_id' => $request->input('nicmu_job_type_id'),
                'nicmu_equipment_id' => $request->input('nicmu_equipment_id'),
                'nicmu_problem_id' => $request->input('nicmu_problem_id'),
            ]);
        

        return redirect()->route('nicmus.index')->with('success', 'NICMU Saved successfully.');
    }

        public function storeJobType(Request $request)
    {

        $nicmu = NicmuJobType::create($request->all());

        return redirect()->route('nicmus.index')->with('success', 'NICMU Job Type added successfully.');
    }
  
    // Handle form submission
    public function storeEquipment(Request $request)
    {
        $nicmu = NicmuEquipment::create($request->all());

        return redirect()->route('nicmus.index')->with('success', 'NICMU Equipment added successfully.');
    }
        public function storeProblem(Request $request)
    {
        $nicmu = NicmuProblem::create($request->all());

        return redirect()->route('nicmus.index')->with('success', 'NICMU Issue/Problem added successfully.');
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

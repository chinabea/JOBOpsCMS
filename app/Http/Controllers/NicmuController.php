<?php

namespace App\Http\Controllers;

use App\Models\Nicmu;
use Illuminate\Http\Request;
use App\Models\NicmuJobType;
use App\Models\NicmuEquipment;
use App\Models\NicmuProblem;
use Illuminate\Support\Facades\Validator;

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

            // if ($validator->fails()) {
            //     return redirect()->back()
            //                 ->withErrors($validator)
            //                 ->withInput()
            //                 ->with('success', 'The data you choose is existing.');
            // }

        $jobTypeId = $request->input('nicmu_job_type_id');
        $equipmentId = $request->input('nicmu_equipment_id');
        $problemIds = $request->input('nicmu_problem_ids');

        foreach ($problemIds as $problemId) {
            Nicmu::create([
                'nicmu_job_type_id' => $jobTypeId,
                'nicmu_equipment_id' => $equipmentId,
                'nicmu_problem_id' => $problemId,
            ]);
        }
        

        return redirect()->route('nicmus.index')->with('success', 'NICMU Saved successfully.');
    }

        public function storeJobType(Request $request)
    {

        $nicmu = NicmuJobType::create($request->all());

        return redirect()->back()->with('success', 'NICMU Job Type added successfully.');

    }
  
    public function storeEquipment(Request $request)
    {
        $nicmu = NicmuEquipment::create($request->all());

        return redirect()->back()->with('success', 'NICMU Equipment added successfully.');
    }

    public function storeProblem(Request $request)
    {
        // Retrieve problem descriptions from the request
        $problemDescriptions = $request->input('problem_description');

        // Loop through each problem description and save it to the database
        foreach ($problemDescriptions as $description) {
            NicmuProblem::create([
                'problem_description' => $description,
            ]);
        }
        return redirect()->back()->with('success', 'NICMU Issue/Problem added successfully.');
    }

    public function jobType_index()
    {
        $jobTypes = NicmuJobType::all();
        return view('units.nicmu.JobTypes.index', compact('jobTypes'));
    }

    public function equipment_index()
    {
        $equipments = NicmuEquipment::all();
        return view('units.nicmu.Equipments.index', compact('equipments'));
    }

    public function problem_index()
    {
        $problems = NicmuProblem::all();
        return view('units.nicmu.Problems.index', compact('problems'));
    }

        public function jobTypeEdit(Request $request, $id)
    {
            $jobType = NicmuJobType::findOrFail($id);
            $jobType->update([
                'jobType_name' => $request->input('edit_jobType_name'),
            ]);
         return redirect()->route('nicmus.JobTypes')->with('success', 'NICMU Job type updated successfully.');
    }
        public function equipmentEdit(Request $request, $id)
    {
            $equipment = NicmuEquipment::findOrFail($id);
            $equipment->update([
                'equipment_name' => $request->input('edit_equipment_name'),
            ]);
         return redirect()->route('nicmus.Equipments')->with('success', 'NICMU Equipment updated successfully.');
    }
    public function problemEdit(Request $request, $id)
    {
            $problem = NicmuProblem::findOrFail($id);
            $problem->update([
                'problem_description' => $request->input('edit_problem_description'),
            ]);
         return redirect()->route('nicmus.Problems')->with('success', 'NICMU Problem updated successfully.');
    }

    // public function show($id)
    // {
    //     $ictram = Ictram::findOrFail($id);
    //     return view('ictrams.index', compact('ictram'));
    // }

    public function destroyJobType($id)
    {
            $jobType = NicmuJobType::findOrFail($id);
            $jobType->delete();
        return redirect()->route('nicmus.JobTypes')->with('success', 'NICMU Job type deleted successfully');
    }
    public function destroyEquipment($id)
    {
            $equipment = NicmuEquipment::findOrFail($id);
            $equipment->delete();
        return redirect()->route('nicmus.Equipments')->with('success', 'NICMU Equipment deleted successfully');
    }
    public function destroyProblem($id)
    {
            $problem = NicmuProblem::findOrFail($id);
            $problem->delete();
        return redirect()->route('nicmus.Problems')->with('success', 'NICMU Problem deleted successfully');
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

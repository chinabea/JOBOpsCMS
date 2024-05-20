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
    //     public function storeWithRelationShip(Request $request)
    // {   
    //     $validator = Validator::make($request->all(), [
    //         'ictram_job_type_id' => 'required|exists:ictram_job_types,id',
    //         'ictram_equipment_id' => 'required|exists:ictram_equipments,id',
    //         'ictram_problem_ids' => 'required|array',
    //         'ictram_problem_ids.*' => 'exists:ictram_problems,id',
    //         'ictram_job_type_id' => 'unique:ictrams,ictram_job_type_id,NULL,id,ictram_equipment_id,' . $request->input('ictram_equipment_id'),
    //     ]);

    //     // if ($validator->fails()) {
    //     //     return redirect()->back()
    //     //                 ->withErrors($validator)
    //     //                 ->withInput()
    //     //                 ->with('success', 'The data you choose is existing.');
    //     // }

    //     $jobTypeId = $request->input('ictram_job_type_id');
    //     $equipmentId = $request->input('ictram_equipment_id');
    //     $problemIds = $request->input('ictram_problem_ids');

    //     foreach ($problemIds as $problemId) {
    //         Ictram::create([
    //             'ictram_job_type_id' => $jobTypeId,
    //             'ictram_equipment_id' => $equipmentId,
    //             'ictram_problem_id' => $problemId,
    //         ]);
    //     }

    //     return redirect()->route('ictrams.index')->with('success', 'ICTRAM Saved successfully.');
    // }

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

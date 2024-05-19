<?php
namespace App\Http\Controllers\ICTRAM;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\IctramJobType;
use App\Models\IctramEquipment;
use App\Models\IctramProblem;
use App\Models\IctramRequest;
use App\Models\Ictram;

class AssignController extends Controller
{
    public function index()
    {
        $ictrams = Ictram::with(['jobType', 'equipment', 'problem'])->get();
        $jobTypes = IctramJobType::all();
        $equipments = IctramEquipment::all();
        $problems = IctramProblem::all();
        $sortedIctrams = $ictrams->sortBy('jobType.jobType_name');
        
        // $ictrams = Ictram::with('jobTypes.equipments.problems')->get();
        
        // return view('units.ictram.index', compact('ictrams'));
        
        return view('units.ictram.index', compact('jobTypes', 'equipments', 'problems', 'sortedIctrams'));
    }
    
    public function storeWithRelationShip(Request $request)
    {   
            $validator = Validator::make($request->all(), [
                'ictram_job_type_id' => 'required',
                'ictram_equipment_id' => 'required',
                'ictram_problem_id' => 'required',
                'ictram_job_type_id' => 'unique:ictram,ictram_job_type_id,NULL,id,ictram_equipment_id,' . $request->input('ictram_equipment_id') . ',ictram_problem_id,' . $request->input('ictram_problem_id'),
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('success', 'The data you choose is existing.');
            }

            Ictram::create([
                'ictram_job_type_id' => $request->input('ictram_job_type_id'),
                'ictram_equipment_id' => $request->input('ictram_equipment_id'),
                'ictram_problem_id' => $request->input('ictram_problem_id'),
            ]);
        

        return redirect()->route('ictrams.index')->with('success', 'ICTRAM Saved successfully.');
    }
}


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
        
        return view('units.ictram.index', compact('jobTypes', 'equipments', 'problems', 'sortedIctrams'));
    }
    
    public function storeWithRelationShip(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'ictram_job_type_id' => 'required|exists:ictram_job_types,id',
            'ictram_equipment_id' => 'required|exists:ictram_equipments,id',
            'ictram_problem_ids' => 'required|array',
            'ictram_problem_ids.*' => 'exists:ictram_problems,id',
            'ictram_job_type_id' => 'unique:ictrams,ictram_job_type_id,NULL,id,ictram_equipment_id,' . $request->input('ictram_equipment_id'),
        ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //                 ->withErrors($validator)
        //                 ->withInput()
        //                 ->with('success', 'The data you choose is existing.');
        // }

        $jobTypeId = $request->input('ictram_job_type_id');
        $equipmentId = $request->input('ictram_equipment_id');
        $problemIds = $request->input('ictram_problem_ids');

        foreach ($problemIds as $problemId) {
            Ictram::create([
                'ictram_job_type_id' => $jobTypeId,
                'ictram_equipment_id' => $equipmentId,
                'ictram_problem_id' => $problemId,
            ]);
        }

        return redirect()->route('ictrams.index')->with('success', 'ICTRAM Saved successfully.');
    }
    public function destroy($id)
    {
            $jobType = Ictram::findOrFail($id);
            $jobType->delete();
        return redirect()->route('ictrams.index')->with('success', 'Deleted successfully');
    }
}


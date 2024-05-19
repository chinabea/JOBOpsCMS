<?php
namespace App\Http\Controllers\ICTRAM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IctramJobType;
use App\Models\IctramEquipment;
use App\Models\IctramProblem;
use App\Models\IctramRequest;

class AssignController extends Controller
{
    public function index()
    {
        // $ictrams = Ictram::all();
        $jobTypes = IctramJobType::all();
        $equipments = IctramEquipment::all();
        $problems = IctramProblem::all();

        
        // $ictrams = Ictram::with('jobTypes.equipments.problems')->get();
        
        // return view('units.ictram.index', compact('ictrams'));
        
        return view('units.ictram.index', compact('jobTypes', 'equipments', 'problems'));
    }
    
    public function storeWithRelationShip(Request $request)
    {   
        IctramRequest::create([
            'ictram_job_type_id' => $request->input('ictram_job_type_id'),
            'ictram_equipment_id' => $request->input('ictram_equipment_id'),
            'ictram_problem_id' => $request->input('ictram_problem_id'),
        ]);
        

        return redirect()->route('ictrams.index')->with('success', 'ICTRAM Saved successfully.');
    }
}


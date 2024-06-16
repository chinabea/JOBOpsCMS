<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictram;
use App\Models\IctramJobType;
use App\Models\IctramEquipment;
use App\Models\IctramProblem;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;

class IctramController extends Controller
{
    
    public function offices()
    {
        // Query to get the offices with the most requested tickets
        $topRequestedOffices = Ticket::select('office_names.office_name as office_name', 'tickets.ictram_id', DB::raw('count(*) as request_count'))
            ->join('office_names', 'tickets.office_name_id', '=', 'office_names.id')
            ->with('ictramEquipment')
            ->groupBy('office_names.office_name', 'tickets.ictram_id')
            ->orderBy('request_count', 'desc')
            ->get();

        // Pass the data to the view
        return view('units.ictram.office-equipments', compact('topRequestedOffices'));
    }

    public function create()
    {
        $jobTypes = IctramJobType::all();
        $equipments = IctramEquipment::all();
    
        return view('units.ictram.create', compact('jobTypes', 'equipments'));
    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'jobType_id' => 'required_without:jobType_name|nullable|exists:ictram_job_types,id',
            'jobType_name' => 'required_without:jobType_id|nullable|string|max:255',
            'equipment_id' => 'required_without:equipment_name|nullable|exists:ictram_equipments,id',
            'equipment_name' => 'required_without:equipment_id|nullable|string|max:255',
            'problem_description' => 'required|string|max:255',
        ]);
    
        // Create or find Job Type
        if ($request->filled('jobType_name')) {
            $jobType = IctramJobType::create(['jobType_name' => $request->input('jobType_name')]);
        } else {
            $jobType = IctramJobType::find($request->input('jobType_id'));
        }
    
        // Create or find Equipment without auto-associating it with an existing job type
        if ($request->filled('equipment_name')) {
            $equipment = IctramEquipment::create([
                'equipment_name' => $request->input('equipment_name'),
                'ictram_job_type_id' => $jobType->id,
            ]);
        } else {
            $equipment = IctramEquipment::find($request->input('equipment_id'));
            // Ensure the equipment is not auto-associated with an existing job type
            if ($equipment && $equipment->ictram_job_type_id != $jobType->id) {
                $equipment->ictram_job_type_id = $jobType->id;
                $equipment->save();
            }
        }
    
        // Create Problem associated with Equipment
        IctramProblem::create([
            'problem_description' => $request->input('problem_description'),
            'ictram_equipment_id' => $equipment->id,
        ]);
    
        return redirect()->back()->with('success', 'ICTRAM records created successfully.');
    }
    
    

    
    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'jobType_name' => 'required|string|max:255',
    //         'equipment_name' => 'required|string|max:255',
    //         'problem_description' => 'required|string|max:255',
    //     ]);
    
    //     // Create Job Type
    //     $jobType = IctramJobType::create(['jobType_name' => $request->input('jobType_name')]);
    
    //     // Create Equipment associated with Job Type
    //     $equipment = IctramEquipment::create([
    //         'equipment_name' => $request->input('equipment_name'),
    //         'ictram_job_type_id' => $jobType->id,
    //     ]);
    
    //     // Create Problem associated with Equipment
    //     IctramProblem::create([
    //         'problem_description' => $request->input('problem_description'),
    //         'ictram_equipment_id' => $equipment->id,
    //     ]);
    
    //     return redirect()->back()->with('success', 'ICTRAM records created successfully.');
    // }
    




    
    public function index()
    {
        // $ictrams = Ictram::all();
        $jobTypes = IctramJobType::all();
        $equipments = IctramEquipment::all();
        $problems = IctramProblem::all();

        
        $ictrams = Ictram::with('jobTypes.equipments.problems')->get();
        
        // return view('units.ictram.index', compact('ictrams'));
        
        return view('units.ictram.index', compact('ictrams', 'jobTypes', 'equipments', 'problems'));
    }

    public function storeJobType(Request $request)
    {

        $ictram = IctramJobType::create($request->all());

        return redirect()->back()->with('success', 'ICTRAM Job Type added successfully.');
    }

        public function storeWithRelationShip(Request $request)
    {   
        IctramEquipment::create([
            'equipment_name' => $request->input('equipment_name'),
            'ictram_job_type_id' => $request->input('ictram_job_type_id'),
        ]);
        
        IctramProblem::create([
            'ictram_equipment_id' => $request->input('ictram_equipment_id'),
            'problem_description' => $request->input('problem_description'),
        ]);

        return redirect()->back()->with('success', 'ICTRAM Job Type created successfully.');
    }

    
    // Handle form submission
    public function storeEquipment(Request $request)
    {
        $ictram = IctramEquipment::create($request->all());

       return redirect()->back()->with('success', 'ICTRAM Equipment added successfully.');
    }
    
    // Handle form submission
    public function storeProblem(Request $request)
    {
        // Retrieve problem descriptions from the request
        $problemDescriptions = $request->input('problem_description');

        // Loop through each problem description and save it to the database
        foreach ($problemDescriptions as $description) {
            IctramProblem::create([
                'problem_description' => $description,
            ]);
        }
        return redirect()->back()->with('success', 'ICTRAM Issue added successfully.');
    }

    public function jobTypeEdit(Request $request, $id)
    {
            $jobType = IctramJobType::findOrFail($id);
            $jobType->update([
                'jobType_name' => $request->input('edit_jobType_name'),
            ]);
         return redirect()->route('ictrams.JobTypes')->with('success', 'ICTRAM Job type updated successfully.');
    }
        public function equipmentEdit(Request $request, $id)
    {
            $equipment = IctramEquipment::findOrFail($id);
            $equipment->update([
                'equipment_name' => $request->input('edit_equipment_name'),
            ]);
         return redirect()->route('ictrams.Equipments')->with('success', 'ICTRAM Equipment updated successfully.');
    }
    public function problemEdit(Request $request, $id)
    {
            $problem = IctramProblem::findOrFail($id);
            $problem->update([
                'problem_description' => $request->input('edit_problem_description'),
            ]);
         return redirect()->route('ictrams.Problems')->with('success', 'ICTRAM Problem updated successfully.');
    }

    public function show($id)
    {
        $ictram = Ictram::findOrFail($id);
        return view('ictrams.index', compact('ictram'));
    }

    public function destroyJobType($id)
    {
            $jobType = IctramJobType::findOrFail($id);
            $jobType->delete();
        return redirect()->route('ictrams.JobTypes')->with('success', 'ICTRAM Job type deleted successfully');
    }
    public function destroyEquipment($id)
    {
            $equipment = IctramEquipment::findOrFail($id);
            $equipment->delete();
        return redirect()->route('ictrams.Equipments')->with('success', 'ICTRAM Equipment deleted successfully');
    }
    public function destroyProblem($id)
    {
            $problem = IctramProblem::findOrFail($id);
            $problem->delete();
        return redirect()->route('ictrams.Problems')->with('success', 'ICTRAM Problem deleted successfully');
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

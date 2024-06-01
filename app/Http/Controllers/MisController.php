<?php

namespace App\Http\Controllers;

use App\Models\Mis;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MisJobType;
use App\Models\MisAsname;
use App\Models\MisRequestType;

class MisController extends Controller
{
    public function index()
    {
        $mises = Mis::with(['jobType', 'requestTypeName', 'asName'])->get();
        $jobTypes = MisJobType::all();
        $requestTypes = MisRequestType::all();
        $asNames = MisAsname::all();
        $sortedMises = $mises->sortBy('requestTypeName.requestType_name');
        return view('units.mis.index', compact('mises', 'jobTypes', 'asNames', 'requestTypes', 'sortedMises' ));
    }

    public function storeWithRelationShip(Request $request)
    {   
        
    //Request type Other
    if ($request->has('requestType_other')) {

        $requestType = MisRequestType::create([
            'requestType_name' => $request->input('requestType_other'),
        ]);
    } else {
        $mis_request_type_id = $request->input('mis_request_type_id');
        
        $requestType = MisRequestType::findOrFail($mis_request_type_id);
    }
    //Job Type Other
    if ($request->has('jobType_other')) {

        $jobType = MisJobType::create([
            'jobType_name' => $request->input('jobType_other'),
        ]);
    } else {
        $mis_job_type_id = $request->input('mis_job_type_id');
        
        $jobType = MisJobType::findOrFail($mis_job_type_id);

    }

    //AsName Other
    if ($request->has('asName_other')) {

        $asNameIds[] = MisAsname::create([
            'name' => $request->input('asName_other'),
        ]);


    } else {
        $mis_asName_id = $request->input('mis_asName_id');
        
        $asNameIds = MisAsname::findOrFail($mis_asName_id);
    }

        foreach ($asNameIds as $asNameId) {
            Mis::create([
                'mis_request_type_id' => $requestType->id,
                'mis_job_type_id' => $jobType->id,
                'mis_asname_id' => $asNameId->id,
            ]);
        }

        return redirect()->back()->with('success', 'MIS Saved successfully.');
    }


    public function jobType_index()
    {
        $jobTypes = MisJobType::all();
        return view('units.mis.JobTypes.index', compact('jobTypes'));
    }

    public function requestType_index()
    {
        $requestTypes = MisRequestType::all();
        return view('units.mis.RequestTypes.index', compact('requestTypes'));
    }

    public function asName_index()
    {
        $asNames = MisAsname::all();
        return view('units.mis.AsNames.index', compact('asNames'));
    }

    public function storeJobType(Request $request)
    {

        MisJobType::create($request->all());

        return redirect()->back()->with('success', 'MIS Job Type added successfully.');

    }
  
    public function storeAsName(Request $request)
    {
        MisAsname::create($request->all());

        return redirect()->back()->with('success', 'MIS Account Name added successfully.');
    }

    public function storeRequestType(Request $request)
    {
        MisRequestType::create($request->all());

        return redirect()->back()->with('success', 'MIS Request Type added successfully.');
    }

     public function jobTypeEdit(Request $request, $id)
    {
            $jobType = MisJobType::findOrFail($id);
            $jobType->update([
                'jobType_name' => $request->input('edit_jobType_name'),
            ]);
         return redirect()->back()->with('success', 'MIS Job type updated successfully.');
    }
        public function requestTypeEdit(Request $request, $id)
    {
            $requestType = MisRequestType::findOrFail($id);
            $requestType->update([
                'requestType_name' => $request->input('edit_requestType_name'),
            ]);
         return redirect()->back()->with('success', 'MIS Request type updated successfully.');
    }
    public function asNameEdit(Request $request, $id)
    {
            $problem = MisAsname::findOrFail($id);
            $problem->update([
                'name' => $request->input('edit_as_name'),
            ]);
         return redirect()->back()->with('success', 'MIS Account Name updated successfully.');
    }

    public function destroyJobType($id)
    {
            $jobType = MisJobType::findOrFail($id);
            $jobType->delete();
         return redirect()->back()->with('success', 'MIS Job type deleted successfully');
    }
    public function destroyrequestType($id)
    {
            $requestType = MisRequestType::findOrFail($id);
            $requestType->delete();
         return redirect()->back()->with('success', 'MIS Request type name deleted successfully');
    }
    public function destroyAsName($id)
    {
            $asName = MisAsname::findOrFail($id);
            $asName->delete();
         return redirect()->back()->with('success', 'NICMU Account name deleted successfully');
    }

    public function create()
    {
        
        return view('unit.mis.create');
    }
    
    public function store(Request $request)
    {
        try {
            // Set a default value for unit if it's not submitted with the form data
            $unit = $request->input('unit', 'MIS-Management Information System');
    
            // Create a new Ictram record with the submitted data
            $mis = Mis::create([
                'unit' => $unit,
                'jobtype' => $request->input('jobtype'),
                'requesttype' => $request->input('requesttype'),
                'asname' => $request->input('asname'),
            ]);
    
            return redirect()->route('mises.create')->with('success', 'ICTRAM Successfully Added!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        $mis = Mis::findOrFail($id);
        return view('mises.edit', compact('mis'));
    }
    public function destroy($id)
    {
        $mis = Mis::findOrFail($id);
        $mis->delete();
        return redirect()->route('mises.index')->with('success', 'MIS deleted successfully');
    }
    
}

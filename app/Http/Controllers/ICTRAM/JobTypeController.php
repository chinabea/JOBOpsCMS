<?php
namespace App\Http\Controllers\ICTRAM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IctramJobType;

class JobTypeController extends Controller
{
       public function index()
    {
        $jobTypes = IctramJobType::all();
        return view('units.ictram.JobTypes.index', compact('jobTypes'));
    }
}


    


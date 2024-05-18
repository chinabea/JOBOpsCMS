<?php
namespace App\Http\Controllers\ICTRAM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IctramProblem;

class ProblemController extends Controller
{
       public function index()
    {
        $problems = IctramProblem::all();
        return view('units.ictram.Problems.index', compact('problems'));
    }
}


    


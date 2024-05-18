<?php
namespace App\Http\Controllers\ICTRAM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IctramProblem;

class ProblemController extends Controller
{
       public function index()
    {
        $problem = IctramProblem::all();
        return view('units.ictram.Problem.index', compact('problem'));
    }
}


    


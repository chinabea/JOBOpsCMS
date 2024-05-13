<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictram;

class ICTRAMController extends Controller
{
    // public function index()
    // {
    //     $ictrams = Ictram::all();
    //     return view('unit.ictram.index', compact('ictrams'));
    // }

    // public function create()
    // {
        
    //     $ictrams = Ictram::all();
    //     return view('unit.ictram.index', compact('ictrams'));
    // }
    // public function store(Request $request)
    // {
    //     try {
    //         // Set a default value for unit if it's not submitted with the form data
    //         $unit = $request->input('unit', 'ICTRAM-ICT Repair and Management');
    
    //         // Create a new Ictram record with the submitted data
    //         $ictram = Ictram::create([
    //             'unit' => $unit,
    //             'jobtype' => $request->input('jobtype'),
    //             'equipment' => $request->input('equipment'),
    //             'problem' => $request->input('problem'),
    //             'is_warrantry' => $request->has('is_warrantry'), // Convert checkbox value to boolean
    //         ]);
    
    //         return redirect()->route('ictrams.create')->with('success', 'ICTRAM Successfully Added!');
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    
    // public function edit($id)
    // {
    //     $ictram = Ictram::findOrFail($id);
    //     return view('ictrams.edit', compact('ictram'));
    // }

    
    // public function show($id)
    // {
    //     $ictram = Ictram::findOrFail($id);
    //     return view('ictrams.index', compact('ictram'));
    // }
    
    // public function destroy($id)
    // {
    //     $ictram = Ictram::findOrFail($id);
    //     $ictram->delete();
    //     return redirect()->route('ictrams.index')->with('success', 'ICTRAM deleted successfully');
    // }


    public function index()
    {
        $ictrams = Ictram::all();
        return view('unit.ictram.index', compact('ictrams'));
    }

    public function create()
    {
        
        $ictrams = Ictram::all();
        return view('unit.ictram.index', compact('ictrams'));
    }
    public function store(Request $request)
    {
        try {
            // Set a default value for unit if it's not submitted with the form data
            $unit = $request->input('unit', 'ICTRAM-ICT Repair and Management');

            // Create a new Ictram record with the submitted data
            $ictram = Ictram::create([
                'unit' => $unit,
                'jobtype' => $request->input('jobtype'),
                'equipment' => $request->input('equipment'),
                'problem' => $request->input('problem'),
                'is_warrantry' => $request->has('is_warrantry'), // Convert checkbox value to boolean
            ]);

            return redirect()->route('ictrams.create')->with('success', 'ICTRAM Successfully Added!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function edit($id)
    {
        $ictram = Ictram::findOrFail($id);
        return view('ictrams.edit', compact('ictram'));
    }


    public function show($id)
    {
        $ictram = Ictram::findOrFail($id);
        return view('ictrams.index', compact('ictram'));
    }

    public function destroy($id)
    {
        $ictram = Ictram::findOrFail($id);
        $ictram->delete();
        return redirect()->route('ictrams.index')->with('success', 'ICTRAM deleted successfully');
    }















}

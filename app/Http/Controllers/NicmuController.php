<?php

namespace App\Http\Controllers;

use App\Models\Nicmu;
use Illuminate\Http\Request;

class NicmuController extends Controller
{
    public function index()
    {
        $nicmus = Nicmu::all();
        return view('nicmus.index', compact('nicmus'));
    }

    public function create()
    {
        return view('nicmus.create');
    }

    public function store(Request $request)
    {
        try {
            
            $nicmu = Nicmu::create($request->all());
            
            return redirect()->route('nicmu')->with('success', 'NICMU Successfully Added!');
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

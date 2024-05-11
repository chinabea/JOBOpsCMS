<?php

namespace App\Http\Controllers;

use App\Models\Mis;
use Illuminate\Http\Request;

class MisController extends Controller
{
    public function index()
    {
        $mises = Mis::all();
        return view('mises.index', compact('mises'));
    }
    public function create()
    {
        return view('mises.create');
    }

    public function store(Request $request)
    {
        try {
            
            $mis = Mis::create($request->all());
            
            return redirect()->route('mis')->with('success', 'MIS Successfully Added!');
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

<?php
namespace App\Http\Controllers\ICTRAM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IctramEquipment;

class EquipmentController extends Controller
{
       public function index()
    {
        $equipments = IctramEquipment::all();
        return view('units.ictram.Equipments.index', compact('equipments'));
    }
}


    


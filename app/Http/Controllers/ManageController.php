<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\IctramJobType;
use App\Models\IctramEquipment;
use App\Models\IctramProblem;
use App\Models\NicmuJobType;
use App\Models\NicmuEquipment;
use App\Models\NicmuProblem;
use App\Models\MisRequestType;
use App\Models\MisAsname;
use App\Models\MisJobType;
use App\Models\OfficeName;
use App\Models\BuildingNumber;


class ManageController extends Controller
{
    public function manage()
    {
        $countIctramJobTypes = IctramJobType::count();
        $countIctramEquipments = IctramEquipment::count();
        $countIctramProblems = IctramProblem::count();

        $countNicmuJobTypes = NicmuJobType::count();
        $countNicmuEquipments = NicmuEquipment::count();
        $countNicmuProblems = NicmuProblem::count();

        $countMisRequests = MisRequestType::count();
        $countMisAsnames = MisAsname::count();
        $countMisJobTypes = MisJobType::count();

        $buildingNumber = BuildingNumber::count();
        $OfficeName = OfficeName::count();
        
        return view('manage', compact('countIctramJobTypes','countIctramEquipments','countIctramProblems',
                                            'countNicmuJobTypes','countNicmuEquipments','countNicmuProblems',
                                            'countMisRequests','countMisAsnames','countMisJobTypes','buildingNumber',
                                            'OfficeName',
                                        ));
    }
}

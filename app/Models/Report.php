<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'name',
        'unit',
        'request',
        'user_id',
        'building_number',
        'office_name',
        'priority_level',
        'description',
        'file_path',
        'status',
        'serial_number',
        'covered_under_warranty',
        'ictram_job_type_id',
        'ictram_equipment_id',
        'ictram_problem_id',
        'nicmu_job_type_id',
        'nicmu_equipment_id',
        'nicmu_problem_id',
        'mis_request_type_id',
        'mis_job_type_id',
        'mis_asname_id',
    ];

}


class IctramJobType extends Model
{
    // Your code here
}

class IctramEquipment extends Model
{
    // Your code here
}

class IctramProblem extends Model
{
    // Your code here
}

class NicmuJobType extends Model
{
    // Your code here
}

class NicmuEquipment extends Model
{
    // Your code here
}

class NicmuProblem extends Model
{
    // Your code here
}

class MisRequestType extends Model
{
    // Your code here
}

class MisJobType extends Model
{
    // Your code here
}

class MisAsname extends Model
{
    // Your code here
}
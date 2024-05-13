<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NicmuRequest extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 
                        'nicmu_job_type_id',
                        'nicmu_equipment_id',
                        'nicmu_problem_id',
                    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nicmu extends Model
{
    use HasFactory;

    protected $table = 'nicmu';
    
    public $fillable = ['nicmu_job_type_id',
                        'nicmu_equipment_id',
                        'nicmu_problem_id' ];

}

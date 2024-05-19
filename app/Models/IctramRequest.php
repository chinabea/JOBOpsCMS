<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IctramRequest extends Model
{
    use HasFactory;

    public $fillable = ['ictram_job_type_id',
                        'ictram_equipment_id',
                        'ictram_problem_id',];
                    
}

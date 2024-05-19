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

    public function jobType()
    {
        return $this->belongsTo(NicmuJobType::class, 'nicmu_job_type_id');
    }

    public function equipment()
    {
        return $this->belongsTo(NicmuEquipment::class, 'nicmu_equipment_id');
    }

    public function problem()
    {
        return $this->belongsTo(NicmuProblem::class, 'nicmu_problem_id');
    }

}

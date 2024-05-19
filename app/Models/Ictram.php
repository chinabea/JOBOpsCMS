<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ictram extends Model
{
    use HasFactory;

    protected $table = 'ictram';
    
    public $fillable = ['ictram_job_type_id',
                        'ictram_equipment_id',
                        'ictram_problem_id' ];

    public function jobType()
    {
        return $this->belongsTo(IctramJobType::class, 'ictram_job_type_id');
    }

    public function equipment()
    {
        return $this->belongsTo(IctramEquipment::class, 'ictram_equipment_id');
    }

    public function problem()
    {
        return $this->belongsTo(IctramProblem::class, 'ictram_problem_id');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IctramEquipment extends Model
{
    use HasFactory;

    protected $table = 'ictram_equipments';

    public $fillable = ['equipment_name',
                        'ictram_job_type_id'];

    
    public function jobType()
    {
        return $this->belongsTo(IctramJobType::class);
    }

    public function problems()
    {
        return $this->hasMany(IctramProblem::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IctramEquipment extends Model
{
    use HasFactory;

    protected $table = 'ictram_equipments';
    
    public $fillable = ['equipment_name'];

    public function jobTypes()
    {
        return $this->belongsToMany(IctramJobType::class, 'ictram_job_type_equipment', 'ictram_equipment_id', 'ictram_job_type_id');
    }

    public function problems()
    {
        return $this->hasMany(IctramProblem::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ictrams()
    {
        return $this->hasMany(Ictram::class, 'ictram_equipment_id');
    }
    


}

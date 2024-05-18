<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IctramJobType extends Model
{
    use HasFactory;
    public $fillable = ['jobType_name'];

    
    public function ictram()
    {
        return $this->belongsTo(Ictram::class);
    }

    // public function equipments()
    // {
    //     return $this->hasMany(IctramEquipment::class);
    // }
    

    public function equipments()
    {
        return $this->belongsToMany(IctramEquipment::class, 'ictram_job_type_equipment', 'ictram_job_type_id', 'ictram_equipment_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}

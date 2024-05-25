<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IctramProblem extends Model
{
    use HasFactory;
    public $fillable = ['problem_description'];
    
    
    public function equipment()
    {
        return $this->belongsTo(ICTRAMEquipment::class, 'ictram_equipment_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ictrams()
    {
        return $this->hasMany(Ictram::class, 'ictram_problem_id');
    }

}

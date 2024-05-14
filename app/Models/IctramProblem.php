<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IctramProblem extends Model
{
    use HasFactory;
    public $fillable = ['problem_description', 
                        'ictram_equipment_id'];
    
    public function equipment()
    {
        return $this->belongsTo(IctramEquipment::class);
    }

}

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
        return $this->belongsTo(IctramEquipment::class);
    }

}

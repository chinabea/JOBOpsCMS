<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemTypeOrEquipment extends Model
{
    use HasFactory;
    
    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;
    
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function problemTypes()
    {
        return $this->hasMany(ProblemType::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    
    public function jobTypes()
    {
        return $this->hasMany(JobType::class);
    }

    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, JobType::class);
    }
}

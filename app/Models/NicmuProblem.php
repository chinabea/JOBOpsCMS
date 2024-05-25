<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NicmuProblem extends Model
{
    use HasFactory;

    public $fillable = ['problem_description'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function nicmus()
    {
        return $this->hasMany(Nicmu::class, 'nicmu_problem_id');
    }
                    
                    

}

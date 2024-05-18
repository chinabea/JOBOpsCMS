<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NicmuProblem extends Model
{
    use HasFactory;
    public $fillable = ['description',
                        'nicmu_equipment_id'];

    

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
                    
                    

}

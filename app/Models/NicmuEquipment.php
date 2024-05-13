<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NicmuEquipment extends Model
{
    use HasFactory;
    
    public $fillable = ['name',
                        'nicmu_job_type_id', ];

}

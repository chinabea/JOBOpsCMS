<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NicmuEquipment extends Model
{
    use HasFactory;

    protected $table = 'nicmu_equipments';
    
    public $fillable = ['equipment_name',
                        'nicmu_job_type_id', ];
    

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}

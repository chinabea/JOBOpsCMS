<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisJobType extends Model
{
    use HasFactory;

    public $fillable = ['jobType_name'
                    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function mis()
    {
        return $this->hasMany(Mis::class, 'mis_job_type_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisRequest extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 
                        'mis_request_type_id',
                        'mis_job_type_id',
                        'mis_asname_id',
                    ];
                    

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisJobType extends Model
{
    use HasFactory;

    public $fillable = ['name',
                        'mis_request_type_id',
                        'asname_id',
                    ];

}

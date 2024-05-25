<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mis extends Model
{
    use HasFactory;

    protected $table = 'mis';
    
    public $fillable = ['mis_request_type_id',
                        'mis_job_type_id',
                        'mis_asname_id' ];
                        
    public function requestTypeName()
    {
        return $this->belongsTo(MisRequestType::class, 'mis_request_type_id');
    }

    public function jobType()
    {
        return $this->belongsTo(MisJobType::class, 'mis_job_type_id');
    }

    public function asName()
    {
        return $this->belongsTo(MisAsName::class, 'mis_asname_id');
    }

}

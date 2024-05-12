<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nicmu extends Model
{
    use HasFactory;
    protected $fillable = ['unit', 'jobtype', 'equipment'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

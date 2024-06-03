<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingNumber extends Model
{
    use HasFactory;    
    
    public $primaryKey = 'id';

    public $fillable = [
        'building_number',
    ];

}

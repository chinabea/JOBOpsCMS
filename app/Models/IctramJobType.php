<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IctramJobType extends Model
{
    use HasFactory;
    public $fillable = ['jobType_name'];

    
    public function ictram()
    {
        return $this->belongsTo(Ictram::class);
    }

    public function equipments()
    {
        return $this->hasMany(IctramEquipment::class);
    }
}

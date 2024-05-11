<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function nicmus()
    {
        return $this->hasMany(Nicmu::class);
    }

    public function mises()
    {
        return $this->hasMany(Mis::class);
    }

    public function ictrams()
    {
        return $this->hasMany(Ictram::class);
    }
}

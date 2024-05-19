<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NicmuJobType extends Model
{
    use HasFactory;
    public $fillable = ['jobType_name'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}

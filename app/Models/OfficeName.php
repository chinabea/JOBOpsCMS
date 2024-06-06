<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeName extends Model
{
    use HasFactory; 
    
    public $primaryKey = 'id';

    public $fillable = [
        'office_name',
    ];
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'office_name_id');
    }

}

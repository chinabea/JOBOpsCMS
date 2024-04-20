<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAssignment extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public $fillable = ['ticket_id', 'status', 'comments'];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}

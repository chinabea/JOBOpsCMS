<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public $fillable = ['service_location','unit_id', 'request', 'priority_level', 'description', 'user_id', 'is_approved', 'deadline', 'file_path'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'ticket_user')
                    ->withTimestamps();
    }
    

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function problemType()
    {
        return $this->belongsTo(ProblemType::class);
    }


}

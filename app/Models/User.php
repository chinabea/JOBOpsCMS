<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'role',
        'phone_number',
        'job_position',
        'expertise',
        'google_id', 
        'avatar',
        'assigned_user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'expertise' => 'array',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ticketssss()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }
    
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
    
    // public function assignedTickets()
    // {
    //     return $this->belongsToMany(Ticket::class);
    // }
    
    // public function tickets()
    // {
    //     return $this->hasMany(Ticket::class);
    // }

    // public function assignedUser()
    // {
    //     return $this->belongsTo(User::class, 'assigned_user_id');
    // }
    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_user_id');
    }
    // public function tickets()
    // {
    //     return $this->belongsToMany(Ticket::class);
    // }
    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_user', 'user_id', 'ticket_id')
                    ->withPivot('escalationReason_for_workloadLimitReached', 'escalatedBy_for_workloadLimitReached', 'escalationReasonDue_to_clientNoncompliance', 'clientNoncomplianceFile')
                    ->withTimestamps();
    }
    
}

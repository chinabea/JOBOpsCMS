<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketUser extends Model
{
    use HasFactory;

    protected $table = 'ticket_user';
    
    public $fillable = [
                        'ticket_id',
                        'user_id',
                        'escalationReason_for_workloadLimitReached',
                        'escalatedBy_for_workloadLimitReached',
                        'escalationReasonDue_to_clientNoncompliance',
                        'clientNoncomplianceFile',
                     ];
    
                    
}

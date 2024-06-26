<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public $fillable = ['building_number_id',
                        'office_name_id',
                        'serial_number', 
                        'priority_level', 
                        'description', 
                        'user_id', 
                        'is_approved', 
                        'deadline', 
                        'file_path',
                        'status', 
                        'ictram_id', 
                        'nicmu_id', 
                        'mis_id', 
                        'reason',
                        'covered_under_warranty',
                        'initial_assessment',
                        'action_performed',
                    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
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

    // ICTRAM relationships
    public function ictramJobType()
    {
        return $this->belongsTo(IctramJobType::class);
    }

    // public function ictramEquipment()
    // {
    //     return $this->belongsTo(IctramEquipment::class);
    // }

    public function ictramProblem()
    {
        return $this->belongsTo(IctramProblem::class);
    }

    // NICMU relationships
    public function nicmuJobType()
    {
        return $this->belongsTo(NicmuJobType::class);
    }

    public function nicmuEquipment()
    {
        return $this->belongsTo(NicmuEquipment::class);
    }

    public function nicmuProblem()
    {
        return $this->belongsTo(NicmuProblem::class);
    }

    // MIS relationships
    public function misRequestType()
    {
        return $this->belongsTo(MisRequestType::class);
    }

    public function misJobType()
    {
        return $this->belongsTo(MisJobType::class);
    }

    public function misAsname()
    {
        return $this->belongsTo(MisAsname::class);
    }
    
    public function ictram()
    {
        return $this->belongsTo(Ictram::class, 'ictram_id');
    }

    public function nicmu()
    {
        return $this->belongsTo(Nicmu::class, 'nicmu_id');
    }

    public function mis()
    {
        return $this->belongsTo(Mis::class, 'mis_id');
    }
    
    public function escalatedBy()
    {
        return $this->belongsTo(User::class, 'escalatedBy_for_workloadLimitReached');
    }
    
    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'ticket_user', 'ticket_id', 'user_id')
                    ->withPivot('escalationReason_for_workloadLimitReached', 'escalatedBy_for_workloadLimitReached', 'escalationReasonDue_to_clientNoncompliance', 'clientNoncomplianceFile')
                    ->withTimestamps();
    }

    // this should be removed
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('escalatedBy_for_workloadLimitReached', 'escalationReason_for_workloadLimitReached');
    }

    /**
     * Get the building number associated with the ticket.
     */
    public function buildingNumber()
    {
        return $this->belongsTo(BuildingNumber::class, 'building_number_id');
    }

    /**
     * Get the office name associated with the ticket.
     */
    public function officeName()
    {
        return $this->belongsTo(OfficeName::class, 'office_name_id');
    }
    
    public function ictramEquipment()
    {
        return $this->belongsTo(IctramEquipment::class, 'ictram_id');
    }
    
    
}

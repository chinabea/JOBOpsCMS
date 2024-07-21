
<!-- Modal -->
<div class="modal fade" id="showTicketModal-{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="showTicketModalLabel-{{ $ticket->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTicketModalLabel">View Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- General Information -->
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Ticket Details</h3>
                            </div>
                            <div class="card-body text-left">
                                <!-- Ticket Details -->
                                <div class="form-group">
                                    <label for="user_id">Requested by</label>
                                    <p class="form-control-static">{{ $ticket->user->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="buildingNumber">Building</label>
                                    <p class="form-control-static">{{ $ticket->buildingNumber->building_number ?? 'N/A' }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="officeName">Office</label>
                                    <p class="form-control-static">{{ $ticket->officeName->office_name ?? 'N/A' }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="unit_request">Unit Request</label>
                                    <p class="form-control-static">{{ $ticket->ictram ? 'ICTRAM' : ($ticket->nicmu ? 'NICMU' : ($ticket->mis ? 'MIS' : 'N/A')) }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="job_type">Job Type</label>
                                    <p class="form-control-static">{{ $ticket->ictram->jobType->jobType_name ?? ($ticket->nicmu->jobType->jobType_name ?? ($ticket->mis->jobType->jobType_name ?? 'N/A')) }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="service_for">Service for</label>
                                    <p class="form-control-static">{{ $ticket->ictram->equipment->equipment_name ?? ($ticket->nicmu->equipment->equipment_name ?? ($ticket->mis->asName->name ?? 'N/A')) }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="issues_or_concern">Issues or Concern</label>
                                    <p class="form-control-static">{{ $ticket->ictram->problem->problem_description ?? ($ticket->nicmu->problem->problem_description ?? ($ticket->mis->requestTypeName->requestType_name ?? 'N/A')) }}</p>
                                </div>
                                <div class="form-group">
                                    <!-- <label for="assigned_to">Assigned To</label> -->
                                    @foreach($ticket->assignedUsers as $user)
                                        @php
                                            $escalatedByUser = App\Models\User::find($user->pivot->escalatedBy_for_workloadLimitReached);
                                        @endphp
                                        <div class="user-info">
                                            <div class="form-group">
                                                <label for="assigned_to">Assigned To/Name</label>
                                                <p class="form-control-static">{{ $user->name }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label>Assigned to Tickets</label>
                                                <p class="form-control-static">{{ $user->tickets->count() }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label>Escalation Reason for Workload Limit Reached</label>
                                                <p class="form-control-static">{{ $user->pivot->escalationReason_for_workloadLimitReached ?? 'N/A' }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label>Escalated By</label>
                                                <p class="form-control-static">{{ $escalatedByUser ? $escalatedByUser->name : 'N/A' }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label>Escalation Reason Due to Client Noncompliance</label>
                                                <p class="form-control-static">{{ $user->pivot->escalationReasonDue_to_clientNoncompliance ?? 'N/A' }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label>Client Noncompliance File</label>
                                                <p class="form-control-static">{{ $user->pivot->clientNoncomplianceFile ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="priority_level">Priority</label>
                                    <p class="form-control-static">{{ $ticket->priority_level }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <p class="form-control-static">{{ $ticket->status }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Attachments -->
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Assessment and Action</h3>
                            </div>
                            <div class="card-body text-left">
                                <div class="form-group">
                                    <label>Initial Assessment</label>
                                    <p class="form-control-static">{{ $ticket->initial_assessment }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="action_performed">Action Taken</label>
                                    <p class="form-control-static">{{ $ticket->action_performed }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="file_path">Uploaded File</label>
                                    <p class="form-control-static">{{ $ticket->file_path }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Reached the Limit of Workload?</h3>
                            </div>
                            <div class="card-body text-left">
                                @if ($ticket->assigned_user_id == auth()->id() || auth()->user()->role == 1)
                                    <div class="form-group">
                                        <label for="reason">Escalation Reason:</label>
                                        <p class="form-control-static">{{ $ticket->reason }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Escalation Reason Due to Client Noncompliance</h3>
                            </div>
                            <div class="card-body text-left">
                                <div class="form-group">
                                    <label for="escalationReasonDue_to_clientNoncompliance">Escalation Reason</label>
                                    <p class="form-control-static">{{ $ticket->escalationReasonDue_to_clientNoncompliance }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="clientNoncomplianceFile">Client Noncompliance File</label>
                                    <p class="form-control-static">{{ $ticket->clientNoncomplianceFile }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



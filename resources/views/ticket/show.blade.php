
<!-- Modal -->
<div class="modal fade" id="showTicketModal-{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="showTicketModalLabel-{{ $ticket->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTicketModalLabel">View Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <!-- Ticket Details -->
                <h5 class="mt-3">Ticket Details</h5>
                <div class="form-group">
                    <label for="requested_by">Requested by</label>
                    <input type="text" class="form-control" id="user_id" value="{{ $ticket->user->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="service_location">Building</label>
                    <input type="text" class="form-control" id="buildingNumber" value="{{ $ticket->buildingNumber->building_number ?? 'N/A' }}" disabled>
                </div>
                <div class="form-group">
                    <label for="service_location">Office</label>
                    <input type="text" class="form-control" id="buildingNumber" value="{{ $ticket->officeName->office_name ?? 'N/A' }}" disabled>
                </div>
                <div class="form-group"> 
                    <label for="service_location">Unit Request</label>
                    @if($ticket->ictram)
                        <input type="text" class="form-control" value="ICTRAM" disabled>
                    @endif
                    @if($ticket->nicmu)
                        <input type="text" class="form-control" value="NICMU" disabled>
                    @endif
                    @if($ticket->mis)
                        <input type="text" class="form-control" value="MIS" disabled>
                    @endif
                </div>
                    <div class="form-group">
                        <label for="service_location">Job Type</label>
                        @if($ticket->ictram)
                        <input type="text" class="form-control" value="{{ $ticket->ictram->jobType->jobType_name }}" disabled>
                        @endif
                        @if($ticket->nicmu)
                        <input type="text" class="form-control" value="{{ $ticket->nicmu->jobType->jobType_name }}" disabled>
                        @endif
                        @if($ticket->mis)
                        <input type="text" class="form-control" value="{{ $ticket->mis->jobType->jobType_name }}" disabled>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="service_location">Service for</label>
                        @if($ticket->ictram)
                        <input type="text" class="form-control" value="{{ $ticket->ictram->equipment->equipment_name }}" disabled>
                        @endif
                        @if($ticket->nicmu)
                        <input type="text" class="form-control" value="{{ $ticket->nicmu->equipment->equipment_name }}" disabled>
                        @endif
                        @if($ticket->mis)
                        <input type="text" class="form-control" value="{{ $ticket->mis->asName->name }}" disabled>
                        @endif
                        
                    </div>
                    <div class="form-group">
                        <label for="service_location">Issues or Concern</label>
                        @if($ticket->ictram)
                        <input type="text" class="form-control" value="{{ $ticket->ictram->problem->problem_description }}" disabled>
                        @endif
                        @if($ticket->nicmu)
                        <input type="text" class="form-control" value="{{ $ticket->nicmu->problem->problem_description }}" disabled>
                        @endif
                        @if($ticket->mis)
                        <input type="text" class="form-control" value="{{ $ticket->mis->requestTypeName->requestType_name }}" disabled>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="priority_level">Priority</label>
                        <input type="text" class="form-control" id="priority_level" value="{{ $ticket->priority_level }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" value="{{ $ticket->status }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="assigned_to">Assigned to</label><br>
                        @foreach($ticket->assignedUsers as $user)
                            {{ $user->name }} <br>
                            Assigned to Tickets: {{ $user->tickets->count() }} - <br>
                            Escalation Reason for Workload Limit Reached: {{ $user->pivot->escalationReason_for_workloadLimitReached }} - <br>
                            @php
                                $escalatedByUser = App\Models\User::find($user->pivot->escalatedBy_for_workloadLimitReached);
                            @endphp
                            Escalated By: {{ $escalatedByUser ? $escalatedByUser->name : 'N/A' }} - <br>
                            Escalation Reason Due to Client Noncompliance: {{ $user->pivot->escalationReasonDue_to_clientNoncompliance }} - <br>
                            Client Noncompliance File: {{ $user->pivot->clientNoncomplianceFile }}
                        @endforeach
                    </div>

                <!-- Assessment and Action -->
                <h5 class="mt-3">Assessment and Action</h5>
                <div class="form-group">
                    <label>Initial Assessment</label>
                    <p>{{ $ticket->initial_assessment }}</p>
                </div>
                <div class="form-group">
                    <label for="action_performed">Action Taken</label>
                    <textarea class="form-control" id="action_performed" disabled>{{ $ticket->action_performed }}</textarea>
                </div>
                <!-- Upload File -->
                <div class="form-group">
                    <label for="file_path">Uploaded File</label>
                    @if ($ticket->file_path)
                        <a href="{{ $ticket->file_path }}" target="_blank">View File</a>
                    @else
                        <p>No file uploaded</p>
                    @endif
                </div>
                
                <!-- Additional Information -->
                <div class="mt-4">
                    <p><strong>Assigned To:</strong> {{ $ticket->assignedUser ? $ticket->assignedUser->name : 'Unassigned' }}</p>
                    <p><strong>Escalation Reason:</strong> {{ $ticket->escalation_reason_for_workload_limit_reached ?? 'None' }}</p>
                </div>
                
                <!-- Escalation Information -->
                @if ($ticket->assigned_user_id == auth()->id() || auth()->user()->role == 1)
                    <hr>
                    <h4>Reached the Limit of Workload?</h4>
                    <p><strong>Escalation Reason:</strong> {{ $ticket->escalation_reason ?? 'None' }}</p>
                @endif
                <hr>
                <h4>Escalation Reason Due to Client Noncompliance</h4>
                <div class="form-group">
                    <p><strong>Reason:</strong> {{ $ticket->escalation_reason_due_to_client_noncompliance ?? 'None' }}</p>
                    @if ($ticket->client_noncompliance_file)
                        <a href="{{ $ticket->client_noncompliance_file }}" target="_blank">View File</a>
                    @else
                        <p>No file uploaded</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



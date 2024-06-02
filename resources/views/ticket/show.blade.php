
<!-- Modal -->
<div class="modal fade" id="showTicketModal" tabindex="-1" role="dialog" aria-labelledby="showTicketModalLabel" aria-hidden="true">
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
                    <input type="text" class="form-control" id="requested_by" value="{{ $ticket->user->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="service_location">Location Service</label>
                    <input type="text" class="form-control" id="service_location" value="{{ $ticket->service_location }}" disabled>
                </div>
                <div class="form-group">
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" id="unit" value="{{ $ticket->unit }}" disabled>
                </div>
                <div class="form-group">
                    <label for="request">Request</label>
                    <input type="text" class="form-control" id="request" value="{{ $ticket->request }}" disabled>
                </div>
                <div class="form-group">
                    <label for="priority_level">Priority</label>
                    <input type="text" class="form-control" id="priority_level" value="{{ $ticket->priority_level }}" disabled>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" value="{{ $ticket->status }}" disabled>
                </div>

                <!-- Assign To -->
                <h5 class="mt-3">Assign To</h5>
                <div class="form-group">
                    <label for="assigned_to">Assigned to</label>
                    <ul>
						@foreach($ticket->assignedUsers as $user)
							<li>{{ $user->name }} - 
								Expertise: {{ implode(', ', $user->expertise ?? ['No Expertise']) }} - 
								Assigned to Tickets: {{ $user->tickets->count() }} - 
								Escalation Reason for Workload Limit Reached: {{ $user->pivot->escalationReason_for_workloadLimitReached }} - 
								Escalated By: {{ $user->pivot->escalatedBy_for_workloadLimitReached }} - 
								Escalation Reason Due to Client Noncompliance: {{ $user->pivot->escalationReasonDue_to_clientNoncompliance }} - 
								Client Noncompliance File: {{ $user->pivot->clientNoncomplianceFile }}
							</li>
						@endforeach

                        <!-- @foreach($ticket->assignedUsers as $user)
                            <li>{{ $user->name }} - Expertise: {{ implode(', ', $user->expertise ?? ['No Expertise']) }} - Assigned to Tickets: {{ $user->tickets->count() }}</li>
                        @endforeach -->
                    </ul>
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



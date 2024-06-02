<!-- Modal -->
<div class="modal fade" id="editTicketModal" tabindex="-1" role="dialog" aria-labelledby="editTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTicketModalLabel">Edit Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <form action="{{ route('edit.ticket', $ticket->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- Ticket Details -->
                    <h5 class="mt-3">Ticket Details</h5>
                    <div class="form-group">
                        <label for="requested_by">Requested by</label>
                        <input type="text" class="form-control" id="requested_by" value="{{ $ticket->user->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="service_location">Location Service</label>
                        <input type="text" class="form-control" id="service_location" name="service_location" value="{{ $ticket->service_location }}">
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select id="unit" class="form-control" name="unit">
                            <option value="MICT" {{ $ticket->unit == 'MICT' ? 'selected' : '' }}>MICT</option>
                            <option value="MIS" {{ $ticket->unit == 'MIS' ? 'selected' : '' }}>MIS</option>
                            <option value="Repair" {{ $ticket->unit == 'Repair' ? 'selected' : '' }}>Repair</option>
                            <option value="Network" {{ $ticket->unit == 'Network' ? 'selected' : '' }}>Network</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="request">Request</label>
                        <input type="text" class="form-control" id="request" name="request" value="{{ $ticket->request }}">
                    </div>
                    <div class="form-group">
                        <label for="priority_level">Priority</label>
                        <select id="priority_level" class="form-control" name="priority_level">
                            <option value="High" {{ $ticket->priority_level == 'High' ? 'selected' : '' }}>High</option>
                            <option value="Mid" {{ $ticket->priority_level == 'Mid' ? 'selected' : '' }}>Mid</option>
                            <option value="Low" {{ $ticket->priority_level == 'Low' ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" class="form-control" name="status">
                            <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <!-- Assign To -->
                    <h5 class="mt-3">Assign To</h5>
                    <div class="form-group">
                        <label for="assigned_to">Assign to<span class="required">*</span></label>
                        <select class="selectpicker form-control" id="assigned_to" name="assigned_to[]" data-live-search="true" multiple>
                            @foreach($userIds as $user)
                                <option value="{{ $user->id }}" data-content="
                                    <span class='text-black'><strong>{{ $user->name }}</strong><br>
                                    <small>Expertise: {{ implode(', ', $user->expertise ?? ['No Expertise']) }}</small><br>
                                    <small>Assigned to Tickets: {{ $user->tickets->count() }}</small></span>">
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Assessment and Action -->
                    <h5 class="mt-3">Assessment and Action</h5>
                    <div class="form-group">
                        <label>Initial Assessment</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="on_site" name="initial_assessment" value="On-Site" {{ $ticket->initial_assessment == 'On-Site' ? 'checked' : '' }}>
                            <label class="form-check-label" for="on_site">On-Site</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="shipped_at_office" name="initial_assessment" value="Shipped at Office" {{ $ticket->initial_assessment == 'Shipped at Office' ? 'checked' : '' }}>
                            <label class="form-check-label" for="shipped_at_office">Shipped at Office</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="action_performed">Action Taken</label>
                        <textarea class="form-control" id="action_performed" name="action_performed">{{ $ticket->action_performed }}</textarea>
                    </div>

                    <!-- Upload File -->
                    <div class="form-group">
                        <label for="file_path">Upload File</label>
                        <input type="file" class="form-control" id="file_path" name="file_path">
                    </div>

                    <!-- Form Actions -->
                    <div class="form-group">
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
                
                <!-- Additional Information -->
                <div class="mt-4">
                    <p><strong>Assigned To:</strong> {{ $ticket->assignedUser ? $ticket->assignedUser->name : 'Unassigned' }}</p>
                    <p><strong>Escalation Reason:</strong> {{ $ticket->escalation_reason_for_workload_limit_reached ?? 'None' }}</p>
                </div>
                
                <!-- Escalation Forms -->
                @if ($ticket->assigned_user_id == auth()->id() || auth()->user()->role == 1)
                    <hr>
                    <h4>Reached the Limit of Workload?</h4>
                    <form action="{{ route('tickets.unassign', $ticket->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="reason">Escalation Reason:</label>
                            <input type="text" name="reason" id="reason" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-danger">Unassign Myself</button>
                    </form>
                @endif
                <hr>
                <h4>Escalation Reason Due to Client Noncompliance</h4>


                <form action="{{ route('nonComplianceEscalation', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="escalationReasonDue_to_clientNoncompliance">Escalation Reason Due to Client Noncompliance:</label>
                        <input type="text" id="escalationReasonDue_to_clientNoncompliance" name="escalationReasonDue_to_clientNoncompliance" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="clientNoncomplianceFile">Client Noncompliance File:</label>
                        <input type="file" id="clientNoncomplianceFile" name="clientNoncomplianceFile" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

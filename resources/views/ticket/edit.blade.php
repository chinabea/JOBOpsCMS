@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ticket Details</h1>
                </div>
                <!-- <div class="col-sm-6">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('office-names.create') }}" class="btn btn-info mr-2">
                            <i class="fas fa-plus"></i> Add Office
                        </a>
                        <button class="btn bg-light text-dark border mr-2" onclick="location.reload();">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- General Information -->
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Ticket Details</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('edit.ticket', $ticket->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            
                            <!-- Ticket Details Form -->
                            <div class="form-group">
                                <label for="user_id">Requested by</label>
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
                                <label for="assigned_to">Assigned To</label>
                                @foreach($ticket->assignedUsers as $user)
                                    @php
                                        $escalatedByUser = App\Models\User::find($user->pivot->escalatedBy_for_workloadLimitReached);
                                    @endphp
                                    <div class="user-info">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Assigned to Tickets</label>
                                            <input type="text" class="form-control" value="{{ $user->tickets->count() }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Escalation Reason for Workload Limit Reached</label>
                                            <input type="text" class="form-control" value="{{ $user->pivot->escalationReason_for_workloadLimitReached ?? 'N/A' }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Escalated By</label>
                                            <input type="text" class="form-control" value="{{ $escalatedByUser ? $escalatedByUser->name : 'N/A' }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Escalation Reason Due to Client Noncompliance</label>
                                            <input type="text" class="form-control" value="{{ $user->pivot->escalationReasonDue_to_clientNoncompliance ?? 'N/A' }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Client Noncompliance File</label>
                                            <input type="text" class="form-control" value="{{ $user->pivot->clientNoncomplianceFile ?? 'N/A' }}" disabled>
                                        </div>
                                    </div>
                                @endforeach
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
                            <button type="submit" class="btn btn-info">Update Ticket</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Attachments -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Details</h3>
                    </div>
                    <div class="card-body">
                            <form action="{{ route('edit.ticket', $ticket->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <h5><i class="fas fa-info"></i> Assessment and Action:</h5>
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
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </form>
                            <!-- <p>--------------------------------------------------</p> -->
                        <!-- Escalation Forms -->
                        @if ($ticket->assigned_user_id == auth()->id() || auth()->user()->role == 1)
                        <br><br>
                                <hr>
                                <h5><i class="fas fa-info"></i> Reached the Limit of Workload?:</h5>
                                <form action="{{ route('tickets.unassign', $ticket->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="reason">Escalation Reason:</label>
                                        <input type="text" name="reason" id="reason" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-danger">Unassign</button>
                                </form>
                            @endif
                            <hr>

                            <!-- --------------------------------- -->
                             <br><br>
                            <h5><i class="fas fa-info"></i> Escalation Reason Due to Client Noncompliance:</h5>
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
    </section>
</div>
@endsection

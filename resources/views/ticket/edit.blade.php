

@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title my-1"><i class="fa fa-book"></i> <b>Submitted Projects</b></h3> <br><br>
                            <form action="{{ route('edit.ticket', $ticket->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                
                                <div class="field item form-group">
                              <label class="col-form-label col-md-3 col-sm-3  label-align">Assign to<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6">
                                <select class="selectpicker form-control" id="assigned_to" name="assigned_to[]" data-live-search="true" multiple>
                                  @foreach($userIds as $user)
                                    <option value="{{ $user->id }}" data-content="
                                      <span class='text-black'><strong><br>{{ $user->name }}</strong><br>
                                      <small>Expertise: {{ implode(', ', $user->expertise ?? ['No Expertise']) }}</small><br>
                                      <small>Assigned to Tickets: {{ $user->tickets->count() }}</small></span>">
                                    </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Requested by <span class="required"></span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="first-name"="required" class="form-control" value="{{ $ticket->user->name }}" disabled>
                              </div>
                            </div>
                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Location Service <span class="required"></span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="service_location" name="service_location"="required" class="form-control" value="{{ $ticket->service_location }}">
                              </div>
                            </div>
                            <div class="item form-group">
                              <label for="unit" class="col-form-label col-md-3 col-sm-3 label-align">Unit</label>
                              <div class="col-md-6 col-sm-6 ">
                                <select id="unit" class="form-control" name="unit">
                                  <option value="MICT" {{ $ticket->unit == 'MICT' ? 'selected' : '' }}> MICT</option>
                                  <option value="MIS" {{ $ticket->unit == 'MIS' ? 'selected' : '' }}>MIS</option>
                                  <option value="Repair" {{ $ticket->unit == 'Repair' ? 'selected' : '' }}>Repair</option>
                                  <option value="Network" {{ $ticket->unit == 'Network' ? 'selected' : '' }}>Network</option>
                                </select>
                              </div>
                            </div>
                            <div class="item form-group">
                              <label for="request" class="col-form-label col-md-3 col-sm-3 label-align">Request</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="request" class="form-control" type="text" name="request" value="{{ $ticket->request }}">
                              </div>
                            </div>
                            <div class="item form-group">
                              <label for="priority_level" class="col-form-label col-md-3 col-sm-3 label-align">Priority</label>
                              <div class="col-md-6 col-sm-6 ">
                                <select id="priority_level" class="form-control" name="priority_level">
                                  <option value="High" {{ $ticket->priority_level == 'High' ? 'selected' : '' }}>High</option>
                                  <option value="Mid" {{ $ticket->priority_level == 'Mid' ? 'selected' : '' }}>Mid</option>
                                  <option value="Low" {{ $ticket->priority_level == 'Low' ? 'selected' : '' }}>Low</option>
                                </select>
                              </div>
                            </div>
                            <div class="item form-group">
                              <label for="status" class="col-form-label col-md-3 col-sm-3 label-align">Status</label>
                              <div class="col-md-6 col-sm-6 ">
                                <select id="status" class="form-control" name="status">
                                  <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                                  <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                  <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                              </div>
                            </div>
                            <div class="item form-group">
                              <label for="file_path" class="col-form-label col-md-3 col-sm-3 label-align">Upload File</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="file_path" class="form-control" type="file" name="file_path">
                              </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Initial Assessment</label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="on_site" name="initial_assessment" value="On-Site" {{ $ticket->initial_assessment == 'On-Site' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="on_site">On-Site</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="shipped_at_office" name="initial_assessment" value="Shipped at Office" {{ $ticket->initial_assessment == 'Shipped at Office' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="shipped_at_office">Shipped at Office</label>
                                    </div>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Action Taken</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" id="action_performed" name="action_performed" value="{{ $ticket->action_performed }}"></textarea>
                                </div>
                            </div>
                
                            <div class="ln_solid"></div>
                              <div class="item form-group justify-content-center">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                <button class="btn btn-primary" id="reset" type="reset">Reset</button>
                                  <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                              </div>
                            </form>
                            <p><strong>Assigned To:</strong> {{ $ticket->assignedUser ? $ticket->assignedUser->name : 'Unassigned' }}</p>
                            <p><strong>Escalation Reason:</strong> {{ $ticket->escalation_reason_for_workload_limit_reached ?? 'None' }}</p>

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
                          

    <form action="{{ route('nonComplianceEscalation') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="escalationReasonDue_to_clientNoncompliance">Escalation Reason Due to Client Noncompliance:</label>
            <input type="text" id="escalationReasonDue_to_clientNoncompliance" name="escalationReasonDue_to_clientNoncompliance">
        </div>
        <div>
            <label for="clientNoncomplianceFile">Client Noncompliance File:</label>
            <input type="file" id="clientNoncomplianceFile" name="clientNoncomplianceFile">
        </div>
        <button type="submit">Submit</button>
    </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection


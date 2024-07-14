@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Requested Tickets</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('create.ticket') }}" class="btn btn-info mr-2">
                            <i class="fas fa-plus"></i> Request Ticket
                        </a>    
                        <button class="btn bg-light text-dark border mr-2" onclick="location.reload();">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-4"></p>
                            <table id="example1" class="table table-bordered table-hover table-sm text-center table-striped">
                                <thead>
                                    <tr class="text-sm">
                                        <th>#</th>
                                        <th>Requesitor</th>
                                        <th>Assigned to</th>
                                        <th>Building Number</th>
                                        <th>Office Name</th>
                                        <th>Unit Request</th>
                                        <th>Job Type</th>
                                        <th>Service for</th>
                                        <th>Issues or Concern</th>
                                        <th>Priority Level</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ticket->user->name }}</td>
                                        <td>
                                        @if($ticket->assignedUsers->contains('pivot.escalationReason_for_workloadLimitReached', true))
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#assignUserModal{{ $ticket->id }}" data-backdrop="static" data-keyboard="false"> 
                                                Assign User 
                                            </button>

                                            <div class="modal fade" id="assignUserModal{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="assignUserModalLabel{{ $ticket->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="assignUserModalLabel{{ $ticket->id }}">Assign User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('tickets.updateUsers', $ticket->id) }}" method="POST">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <select class="selectpicker form-control" id="assigned_user_id{{ $ticket->id }}" name="assigned_user_id[]" data-live-search="true" multiple required>
                                                                        @foreach($userIds as $user)
                                                                            @if($ticket->ictram && in_array($user->role, [2, 7]))
                                                                                <option value="{{ $user->id }}" data-content="
                                                                                    <span class='text-black'><strong>{{ $user->name }}</strong><br>
                                                                                    <small>Expertise: {{ implode(', ', $user->expertise ?? []) }}</small><br>
                                                                                    <small>Assigned to Tickets: {{ $user->tickets->count() }}</small></span>">
                                                                                </option>
                                                                            @elseif($ticket->nicmu && in_array($user->role, [3, 8]))
                                                                                <option value="{{ $user->id }}" data-content="
                                                                                    <span class='text-black'><strong>{{ $user->name }}</strong><br>
                                                                                    <small>Expertise: {{ implode(', ', $user->expertise ?? []) }}</small><br>
                                                                                    <small>Assigned to Tickets: {{ $user->tickets->count() }}</small></span>">
                                                                                </option>
                                                                            @elseif($ticket->mis && in_array($user->role, [4, 9]))
                                                                                <option value="{{ $user->id }}" data-content="
                                                                                    <span class='text-black'><strong>{{ $user->name }}</strong><br>
                                                                                    <small>Expertise: {{ implode(', ', $user->expertise ?? []) }}</small><br>
                                                                                    <small>Assigned to Tickets: {{ $user->tickets->count() }}</small></span>">
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Assign</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($userIds->isNotEmpty() && !$ticket->escalationReason_for_workloadLimitReached)
                                            <div class="dropdown">
                                                <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $ticket->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                                                    View Users 
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $ticket->id }}">
                                                    @foreach ($ticket->users as $assigned_user)
                                                        @if($ticket->ictram && in_array($assigned_user->role, [2, 7]))
                                                            <a class="dropdown-item">
                                                                <strong>{{ $assigned_user->name }}</strong><br>
                                                                <small>Expertise: {{ implode(', ', $assigned_user->expertise ?? []) }}</small><br>
                                                                <small>Assigned to Tickets: {{ $assigned_user->tickets->count() }}</small>
                                                            </a>
                                                        @elseif($ticket->nicmu && in_array($assigned_user->role, [3, 8]))
                                                            <a class="dropdown-item">
                                                                <strong>{{ $assigned_user->name }}</strong><br>
                                                                <small>Expertise: {{ implode(', ', $assigned_user->expertise ?? []) }}</small><br>
                                                                <small>Assigned to Tickets: {{ $assigned_user->tickets->count() }}</small>
                                                            </a>
                                                        @elseif($ticket->mis && in_array($assigned_user->role, [4, 9]))
                                                            <a class="dropdown-item">
                                                                <strong>{{ $assigned_user->name }}</strong><br>
                                                                <small>Expertise: {{ implode(', ', $assigned_user->expertise ?? []) }}</small><br>
                                                                <small>Assigned to Tickets: {{ $assigned_user->tickets->count() }}</small>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        </td>
                                        <td>{{ $ticket->buildingNumber->building_number ?? 'N/A' }}</td>
                                        <td>{{ $ticket->officeName->office_name ?? 'N/A' }}</td>
                                        @if($ticket->ictram)
                                            <td>ICTRAM</td>
                                            <td>{{ $ticket->ictram->jobType->jobType_name }} </td>
                                            <td>{{ $ticket->ictram->equipment->equipment_name }}</td>
                                            <td>{{ $ticket->ictram->problem->problem_description }}</td>
                                        @endif
                                        @if($ticket->nicmu)
                                            <td>NICMU</td>
                                            <td>{{ $ticket->nicmu->jobType->jobType_name }}</td>
                                            <td>{{ $ticket->nicmu->equipment->equipment_name }}</td>
                                            <td>{{ $ticket->nicmu->problem->problem_description }}</td>
                                        @endif
                                        @if($ticket->mis)
                                            <td>MIS</td>
                                            <td>{{ $ticket->mis->jobType->jobType_name }}</td>
                                            <td>{{ $ticket->mis->asName->name }}</td> 
                                            <td>{{ $ticket->mis->requestTypeName->requestType_name }}</td>
                                        @endif
                                        <td class="align-middle"> 
                                            @if ($ticket->priority_level === 'High')
                                            <span class="badge badge-danger">High</span>
                                            @elseif ($ticket->priority_level === 'Mid')
                                            <span class="badge badge-warning">Mid</span>
                                            @elseif ($ticket->priority_level === 'Low')
                                            <span class="badge badge-secondary">Low</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-danger">{{ $ticket->status }}</span>
                                        </td>
                                        <td>{{ $ticket->created_at ? $ticket->created_at->format('F j, Y g:i A') : 'N/A' }}</td>
                                      
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

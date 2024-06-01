@extends('layouts.template') @section('content') <div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title my-1"><i class="fa fa-book"></i> <b>Submitted Projects</b></h3> <br><br>
                            <form action="{{ route('open-status.report') }}" method="post"> @csrf <div class="row justify-content-center">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" class="form-control" name="start_date" id="start_date">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_date">End Date:</label>
                                            <input type="date" class="form-control" name="end_date" id="end_date">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Actions</label>
                                            <div>
                                                <button type="button" id="reset" class="btn btn-warning"><i class="fa fa-refresh"></i> </button>
                                                <button type="submit" class="btn btn-info"><i class="fa fa-file-pdf"></i> Generate PDF</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="datatable" class="table table-bordered table-hover text-center table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><i class="fa fa-user"></i> Request by</th>
                                        <th><i class="fa fa-location-arrow"></i> Location</th>
                                        <th><i class="fa fa-university"></i> Unit</th>
                                        <th><i class="fa fa-wrench"></i> Request</th>
                                        <th><i class="fa fa-users"></i> Assigned to</th>
                                        <th><i class="fa fa-flag"></i> Priority Level</th>
                                        <th><i class="fa fa-tasks"></i> Status</th> @if(auth()->user()->role == 1) <th><i class="fa fa-pencil-square-o"></i> Action(s)</th> @endif
                                    </tr>
                                </thead>
                                <tbody> @foreach($tickets as $ticket) @if(auth()->user()->role == 1 || auth()->user()->id == $ticket->user_id || (auth()->user()->role == 3 || $ticket->assigned_to == auth()->id())) <tr>
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $ticket->user->name }}</td>
                                        <td class="align-middle">{{ $ticket->service_location }}</td>
                                        <td class="align-middle">{{ $ticket->unit }}</td>
                                        <td class="align-middle">{{ $ticket->request }}</td>
                                        <td> 
                                            @if(is_null($ticket->assigned_user_id))
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#assignUserModal{{ $ticket->id }}" data-backdrop="static" data-keyboard="false"> Assign User </button>
                                            <!-- Modal -->
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
                                                            <!-- Form inside modal -->
                                                            <form action="{{ route('tickets.updateUsers', $ticket->id) }}" method="POST"> @csrf <div class="form-group">
                                                                    <select class="selectpicker form-control" id="assigned_user_id{{ $ticket->id }}" name="assigned_user_id[]" data-live-search="true" multiple required> @foreach($userIds as $user) <option value="{{ $user->id }}" data-content="
                                                            <span class='text-black'><strong><br>{{ $user->name }}</strong><br>
                                                            <small>Expertise: {{ implode(', ', $user->expertise ?? []) }}</small><br>
                                                            <small>Assigned to Tickets: {{ $user->tickets->count() }}</small></span>">
                                                                        </option> @endforeach </select>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Assign</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> 
                                            @else 
                                            <div class="dropdown">
                                                <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $ticket->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> View Users </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $ticket->id }}">
                                                    @if($ticket->assignedUser)
                                                        <a class="dropdown-item">
                                                            <strong>{{ $ticket->assignedUser->name }}</strong>
                                                        </a>
                                                    @else
                                                        <span class="dropdown-item">No user assigned</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $ticket->priority_level }}</td> @if(auth()->user()->role == 1 || (auth()->user()->role == 2)) <td>
                                            <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST"> @csrf @method('PATCH') <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                    <option value="Open" @if ($ticket->status == 'Open') selected @endif>Open</option>
                                                    <option value="In Progress" @if ($ticket->status == 'In Progress') selected @endif>In Progress</option>
                                                    <option value="Closed" @if ($ticket->status == 'Closed') selected @endif>Closed</option>
                                                    <option value="Completed" @if ($ticket->status == 'Completed') selected @endif>Completed</option>
                                                </select>
                                            </form>
                                        </td> @else <td class="align-middle"><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $ticket->status }}</small></td> @endif @if(auth()->user()->role == 1) <td class="align-middle">
                                            <a href="{{ route('ticket.show', $ticket->id) }}" type="button" class="btn btn-sm btn-secondary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('update.ticket', $ticket->id) }}" type="button" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('destroy.ticket', $ticket->id) }}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td> @endif
                                    </tr> @endif @endforeach </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> @endsection
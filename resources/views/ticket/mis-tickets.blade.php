@extends('layouts.template') @section('content') <div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title font-weight-bold">Submitted Projects</h1>
                            <div class="mb-5"></div>
                            <table id="example1" class="table table-bordered table-hover text-center table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><i class="fa fa-user"></i> Requestor</th>
                                        <th><i class="fa fa-location-arrow"></i> Location</th>
                                        <th><i class="fa fa-university"></i> Job Type</th>
                                        <th><i class="fa fa-wrench"></i> Equipment / Issues</th>
                                        <th><i class="fa fa-users"></i> Assigned to</th>
                                        <th><i class="fa fa-tasks"></i> Status</th> @if(auth()->user()->role == 1) <th><i class="fa fa-pencil-square-o"></i> Action(s)</th> @endif
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($tickets as $ticket) 
                                        @if ($ticket->mis_job_type_id)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ticket->user->name }}</td>
                                            <td>
                                                {{ $ticket->building_number }},
                                                {{ $ticket->office_name }}
                                            </td>
                                            <td>{{ $ticket->misRequestType->requestType_name }}</td>
                                            <td>
                                                {{ $ticket->misJobType->jobType_name }} - 
                                                {{ $ticket->misAsname->name }}

                                            <td> @if($ticket->users->isEmpty())
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
                                                </div> @else <div class="dropdown">
                                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $ticket->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> View Users </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $ticket->id }}"> @foreach ($ticket->users as $assigned_user) <a class="dropdown-item">
                                                            <strong>{{ $assigned_user->name }}</strong><br>
                                                            <small>Expertise: {{ implode(', ', $assigned_user->expertise ?? []) }}</small><br>
                                                            <small>Assigned to Tickets: {{ $assigned_user->tickets->count() }}</small>
                                                        </a> @endforeach </div>
                                                </div> @endif
                                            </td>
                                            @if(auth()->user()->role == 1 || (auth()->user()->role == 2)) <td>
                                                <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST"> @csrf @method('PATCH') <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                        <option value="Open" @if ($ticket->status == 'Open') selected @endif>Open</option>
                                                        <option value="In Progress" @if ($ticket->status == 'In Progress') selected @endif>In Progress</option>
                                                        <option value="Closed" @if ($ticket->status == 'Closed') selected @endif>Closed</option>
                                                    </select>
                                                </form>
                                            </td> @else <td class="align-middle"><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $ticket->status }}</small></td> @endif @if(auth()->user()->role == 1) <td>
                                                <div class="item form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="btn-group">
                                                            <a href="{{ route('ticket.show', $ticket->id) }}" type="button" class="btn btn-sm btn-secondary">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('update.ticket', $ticket->id) }}" type="button" class="btn btn-sm btn-warning">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('destroy.ticket', $ticket->id) }}')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td> 
                                            @endif
                                        </tr>
                                        
                                        @endif
                                        
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> @endsection
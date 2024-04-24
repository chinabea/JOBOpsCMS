@extends('layouts.template')

@section('content')
<div class="right_col" role="main" style="min-height: 606.8px;">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Tickets</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Requested Tickets</h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="{{ route('create.ticket') }}" class="btn btn-round btn-success">
                  <i class="fa fa-plus-square"></i> Add Ticket
              </a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-bordered table-hover text-center table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Request by</th>
                        <th>Location</th>
                        <th>Unit</th>
                        <th>Request</th>
                        <th>Assigned to</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Action(s)</th>
                    </tr>
                </thead>
                <tbody>
                    @if($tickets->count() > 0)
                    @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ticket->user->name }}</td>
                        <td>{{ $ticket->service_location }}</td>
                        <td>{{ $ticket->unit }}</td>
                        <td>{{ $ticket->request }}</td>
                        <td>{{ $ticket->assignedUser->name }}</td>
                        <td>{{ $ticket->priority_level }}</td>
                        <td>@if ($ticket->status === 'Open')
                            <span class="badge badge-primary">Open</span>
                          @elseif ($ticket->status === 'In Progress')
                            <span class="badge badge-info">In Progress</span>
                          @elseif ($ticket->status === 'Closed')
                            <span class="badge badge-warning">Closed</span>
                          @endif
                        </td>
                        <td>
                            <a href="{{ route('update.ticket', $ticket->id) }}" type="button"
                                class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('destroy.ticket', $ticket->id) }}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

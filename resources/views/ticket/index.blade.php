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
          <form action="{{ route('generate.tickets.report') }}" method="post">
              @csrf
              <div class="row justify-content-center">
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
            <table id="datatable-responsive" class="table table-bordered table-hover text-center table-striped table-sm">
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
                        @if(auth()->user()->role == 1)
                        <th>Action(s)</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if($tickets->count() > 0)
                    @foreach($tickets as $ticket)
                    @if(auth()->user()->role == 1 || (auth()->user()->role == 2 && $ticket->assigned_to == auth()->id()))
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ticket->user->name }}</td>
                        <td>{{ $ticket->service_location }}</td>
                        <td>{{ $ticket->unit }}</td>
                        <td>{{ $ticket->request }}</td>
                        <td>{{ $ticket->assignedUser->name }}</td>
                        <td>{{ $ticket->priority_level }}</td>
                        <td>
                          <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                  <option value="Open" @if ($ticket->status == 'Open') selected @endif>Open</option>
                                  <option value="In Progress" @if ($ticket->status == 'In Progress') selected @endif>In Progress</option>
                                  <option value="Closed" @if ($ticket->status == 'Closed') selected @endif>Closed</option>
                              </select>
                          </form>
                        </td>
                        @if(auth()->user()->role == 1)
                        <td>
                            <a href="{{ route('update.ticket', $ticket->id) }}" type="button"
                                class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('destroy.ticket', $ticket->id) }}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        @endif
                      </tr>
                      @endif
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

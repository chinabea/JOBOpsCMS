@extends('layouts.template')

@section('content')
<div class="right_col" role="main" style="min-height: 606.8px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Plain Page</h3>
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
                    <h2>All Tickets</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    <!-- <button type="button" class="">Success</button> -->
                                <a href="{{ route('create.ticket') }}" class="btn btn-round btn-success">
                                    <i class="fa fa-plus-square"></i> Add Ticket
                                </a>
                      <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li> -->
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
                                <th>Priotrity</th>
                                <th>Status</th>
                                <th>Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($tickets->count() > 0)
                            @foreach($tickets as $ticket)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $ticket->user->name }}</td>
                                <td class="align-middle">{{ $ticket->service_location }}</td>
                                <td class="align-middle">{{ $ticket->unit }}</td>
                                <td class="align-middle">{{ $ticket->request }}</td>
                                <td class="align-middle">{{ $ticket->assignedUser->name }}</td>
                                <td class="align-middle">{{ $ticket->priority_level }}</td>
                                <td class="align-middle"><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $ticket->status }}</small></td>
                                
                                <td class="align-middle">
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

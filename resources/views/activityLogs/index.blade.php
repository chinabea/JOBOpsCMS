@extends('layouts.template')

@section('content')
<div class="right_col" role="main" style="min-height: 606.8px;">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Activity Logs</h3>
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
            <h2>Logs</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"> 
            <table id="datatable-responsive" class="table table-bordered table-hover text-center table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Created At</th>
                        <th>Name</th>
                        <th>Label</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $log->created_at }}</td>
                        <td>{{ $log->user->name }}</td>
                        <td>{{ class_basename($log->model_type) }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->description }}</td>
                    
<td>
    @if ($log->action === 'Deleted')
        {{ $log->subject->request ?? 'Deleted Item' }}
    @elseif ($log->action === 'Created' || $log->action === 'Updated')
                          <a href="{{ route('ticket.show', $log->model_id) }}">{{ $log->subject->request }}</a>
    @else
        <a href="{{ route('ticket.show', $log->model_id) }}">
            {{ $log->subject->request ?? 'No Request Found' }}
        </a>
    @endif
</td>


                      </tr>
                      @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

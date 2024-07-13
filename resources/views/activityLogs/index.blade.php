
@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Activity Logs</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-end">
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
                              <table id="example1" class="table table-bordered table-hover text-center table-striped table-sm">
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
    @elseif ($log->action === 'Created' || $log->action === 'Updated' || $log->action === 'Approved' || $log->action === 'Disapproved')
        @if ($log->model_type === 'App\Models\FAQs')
            {{-- If the log is related to FAQs, display this custom view --}}
            <a href="{{ route('faq.show', $log->model_id) }}">{{ $log->subject->question ?? 'Question Not Found' }}</a>
        @elseif ($log->model_type === 'App\Models\Ticket')
            {{-- If the log is related to Tickets, display another custom view --}}
            <a href="{{ route('ticket.show', $log->model_id) }}">{{ $log->subject->request ?? 'Request Not Found' }}</a>
        @elseif ($log->model_type === 'App\Models\User')
            {{-- If the log is related to Users, display another custom view --}}
            <a href="{{ route('user.edit', $log->model_id) }}">{{ $log->subject->name ?? 'Name Not Found' }}</a>
        @else
            {{-- Default case if none of the above --}}
            <a href="#">{{ $log->subject->request ?? 'Unknown Type' }}</a>
        @endif
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
    </section>
</div>

@endsection


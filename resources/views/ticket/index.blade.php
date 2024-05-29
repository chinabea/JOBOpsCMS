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
                            <table id="example1" class="table table-bordered table-hover text-center table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Requester</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Priority Level</th>
                                        <th>Status</th>
                                        <th>Age</th>
                                        <th>Created at</th>
                                        @if(auth()->user()->role == 1)
                                        <th>Action(s)</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                    @if(auth()->user()->role == 1 || auth()->user()->id == $ticket->user_id || (auth()->user()->role == 2 && $ticket->assigned_to == auth()->id()))
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ticket->user->name }}</td>
                                        <td>{{ $ticket->building_number }}, {{ $ticket->office_name }}</td>
                                        <td>{{ $ticket->description }}</td>
                                        <td>
                                        @if(auth()->user()->role == 1 || (auth()->user()->role == 2) || (auth()->user()->role == 3) || (auth()->user()->role == 4))
                                            <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                document.getElementById('priority_levelSelect-{{ $ticket->id }}').addEventListener('change', function() {
                                                    const form = document.getElementById('priority_levelForm-{{ $ticket->id }}');
                                                    form.submit();
                                                });
                                            });
                                            </script>

                                            <form action="{{ route('tickets.updatePriorityLvl', $ticket->id) }}" method="POST" id="priority_levelForm-{{ $ticket->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="priority_level" class="form-control form-control-sm" id="priority_levelSelect-{{ $ticket->id }}">
                                                    <option value="" selected disabled>Select Priority Level</option>
                                                    <option value="High" @if ($ticket->priority_level == 'High') selected @endif>High</option>
                                                    <option value="Mid" @if ($ticket->priority_level == 'Mid') selected @endif>Mid</option>
                                                    <option value="Low" @if ($ticket->priority_level == 'Low') selected @endif>Low</option>
                                                </select>
                                            </form>
                                        </td>
                                        @else
                                            @if ($ticket->priority_level === 'High')
                                            <span class="badge badge-danger">High</span>
                                            @elseif ($ticket->priority_level === 'Mid')
                                            <span class="badge badge-warning">Mid</span>
                                            @elseif ($ticket->priority_level === 'Low')
                                            <span class="badge badge-secondary">Low</span>
                                            @endif
                                        @endif
                                        @if(auth()->user()->role == 1 || (auth()->user()->role == 2))
                                        <td>
                                            <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST" id="statusForm-{{ $ticket->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-control form-control-sm" id="statusSelect-{{ $ticket->id }}">
                                                    <option value="Open" @if ($ticket->status == 'Open') selected @endif>Open</option>
                                                    <option value="In Progress" @if ($ticket->status == 'In Progress') selected @endif>In Progress</option>
                                                    <option value="Closed" @if ($ticket->status == 'Closed') selected @endif>Closed</option>
                                                </select>
                                                <input type="hidden" name="reason" id="reasonInput-{{ $ticket->id }}" value="">
                                            </form>
                                            @if ($ticket->status == 'In Progress')
                                            <button type="button" class="btn btn-xs" data-toggle="tooltip" data-placement="right" title="{{ $ticket->reason }}">
                                                <i class="fas fa-comment"></i>
                                            </button>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                            $totalSeconds = 3 * 24 * 60 * 60; // Total duration in seconds (example: 3 days)
                                            $elapsedSeconds = $ticket->created_at->diffInSeconds(now());
                                            $progressPercentage = ($elapsedSeconds / $totalSeconds) * 100;
                                            @endphp
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>{{ $ticket->created_at ? $ticket->created_at->format('F j, Y g:i A') : 'N/A' }}</td>
                                        @else
                                        <td class="align-middle">
                                            <small class="badge badge-warning">
                                                <i class="far fa-clock"></i> {{ $ticket->status }}
                                            </small>
                                        </td>
                                        @endif
                                        @if(auth()->user()->role == 1)
                                        <td>
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
</div>
<script>
    document.querySelectorAll('select[id^="statusSelect-"]').forEach(function(selectElement) {
        selectElement.addEventListener('change', function() {
            const ticketId = this.id.split('-')[1];
            const form = document.getElementById(`statusForm-${ticketId}`);
            const selectedStatus = this.value;
            const currentStatus = this.getAttribute('data-current-status');

            if (selectedStatus === 'In Progress' && currentStatus !== 'In Progress') {
                const reason = prompt("Why is this ticket being marked as 'In Progress'?");
                if (reason !== null && reason.trim() !== "") {
                    document.getElementById(`reasonInput-${ticketId}`).value = reason;
                    form.submit();
                } else {
                    alert("You must provide a reason to mark this ticket as 'In Progress'.");
                    this.value = currentStatus; // Reset to the current status
                }
            } else {
                form.submit();
            }
        });
    });
</script>

@endsection

@extends('layouts.template') 

@section('content') 

<div id="ticketList">
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
                        <a href="#" class="btn bg-light text-dark border mr-2" data-widget="control-sidebar" data-slide="true">
                            <i class="fas fa-filter"></i> Filters <i class="fas fa-angle-right left"></i>
                        </a>
                        @include('filters')
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
                            <table class="table table-bordered table-hover table-sm text-center table-striped">
                                <thead>
                                    <tr class="text-sm">
                                        <th>#</th>
                                        <th>Requesitor</th>
                                        <th>Assigned to</th>
                                        <th>Building</th>
                                        <th>Office</th>
                                        <th>Unit Request</th>
                                        <th>Job Type</th>
                                        <th>Service for</th>
                                        <th>Issues or Concern</th>
                                        <th>Priority Level</th>
                                        <th>Status</th>
                                        <th>Age</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                    @if(auth()->user()->role == 1 || auth()->user()->id == $ticket->user_id || (auth()->user()->role == 2 && $ticket->assigned_to == auth()->id()))
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ticket->user->name }}</td>
                                        <td>
                                            @foreach ($ticket->users as $assigned_user)
                                                @if($ticket->ictram && in_array($assigned_user->role, [2, 7]))
                                                    {{ $assigned_user->name }}
                                                @elseif($ticket->nicmu && in_array($assigned_user->role, [3, 8]))
                                                    {{ $assigned_user->name }}
                                                @elseif($ticket->mis && in_array($assigned_user->role, [4, 9]))
                                                    {{ $assigned_user->name }}
                                                @endif
                                            @endforeach
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
                                        <td> 
                                            @if ($ticket->priority_level === 'High')
                                            <span>High</span>
                                            @elseif ($ticket->priority_level === 'Mid')
                                            <span>Mid</span>
                                            @elseif ($ticket->priority_level === 'Low')
                                            <span>Low</span>
                                            @endif
                                        </td>
                                        <td>{{ $ticket->status }}</td>
                                        <td>
                                            @php
                                                $totalSeconds = 3 * 24 * 60 * 60; // Total duration in seconds (example: 3 days)
                                                $elapsedSeconds = $ticket->created_at->diffInSeconds(now());
                                                $progressPercentage = ($elapsedSeconds / $totalSeconds) * 100;

                                                $ageInDays = (int) $ticket->created_at->diffInDays(now());
                                                if ($ageInDays == 0) {
                                                    $progressClass = 'bg-info';
                                                } elseif ($ageInDays == 1) {
                                                    $progressClass = 'bg-warning';
                                                } elseif ($ageInDays >= 2) {
                                                    $progressClass = 'bg-danger';
                                                } else {
                                                    $progressClass = 'bg-success'; // Default if not in the first 3 days
                                                }
                                            @endphp
                                            {{ $ageInDays }} days
                                        </td>
                                        <td>{{ $ticket->created_at ? $ticket->created_at->format('F j, Y g:i A') : 'N/A' }}</td>
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
@endsection

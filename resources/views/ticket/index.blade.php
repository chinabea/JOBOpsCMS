

@extends('layouts.template')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title"><b>Tickets</b></h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                                <a href="{{ route('create.ticket') }}" class="btn bg-navy color-palette btn-sm float-right">
                                    <i class="fas fa-plus"></i> Add Ticket
                                </a>
                                    <br><br>
                                    <form action="{{ route('generate.tickets.report') }}" method="post">
                                        @csrf
                                        <div class="row align-items-center">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="start_date">Start Date:</label>
                                                        <input type="date" class="form-control" name="start_date" id="start_date">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="end_date">To:</label>
                                                        <input type="date" class="form-control" name="end_date" id="end_date">
                                                    </div>
                                                </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Actions</label>
                                                    <div>
                                                        <button type="button" id="reset" class="btn btn-warning"><i class="fa fa-sync"></i> </button>
                                                        <button type="submit" class="btn btn-info"><i class="fa fa-file-pdf"></i> Generate PDF</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                            <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover text-center table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Request by</th>
                                        <th>Location</th>
                                        <th>Unit</th>
                                        <th>Request</th>
                                        <th>Assigned to</th>
                                        <th>Status</th>
                                        <th>Action(s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($tickets->count() > 0)
                                    @foreach($tickets as $ticket)
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $ticket->user->first_name }} {{ $ticket->user->last_name }}</td>
                                        <td class="align-middle">{{ $ticket->service_location }}</td>
                                        <td class="align-middle">{{ $ticket->unit }}</td>
                                        <td class="align-middle">{{ $ticket->request }}</td>
                                        <td class="align-middle">{{ $ticket->assignedUser->first_name }} {{ $ticket->assignedUser->last_name }}</td>
                                        <td class="align-middle">Status</td>
                                        <td class="align-middle">
                                            <a href="{{ route('update.ticket', $ticket->id) }}" type="button"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('destroy.ticket', $ticket->id) }}')">
                                                <i class="fas fa-trash"></i>
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
    </section>
</div>


<script>
$(document).ready(function() {
    $('#example1').DataTable();
});
</script>

@if(session('success'))
<script>
    toastr.success('{{ session('success') }}');
</script>
@elseif(session('delete'))
<script>
    toastr.delete('{{ session('delete') }}');
</script>
@elseif(session('message'))
<script>
    toastr.message('{{ session('message') }}');
</script>
@elseif(session('error'))
<script>
    toastr.error('{{ session('error') }}');
</script>
@endif

@endsection

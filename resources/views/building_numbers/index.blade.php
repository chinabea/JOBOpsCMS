
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
                            <a href="{{ route('building-numbers.create') }}">Add Building Number</a>
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Building Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buildingNumbers as $buildingNumber)
                                        <tr>
                                            <td>{{ $buildingNumber->id }}</td>
                                            <td>{{ $buildingNumber->building_number }}</td>
                                            <td>
                                                <a href="{{ route('building-numbers.show', $buildingNumber->id) }}">Show</a>
                                                <a href="{{ route('building-numbers.edit', $buildingNumber->id) }}">Edit</a>
                                                <form action="{{ route('building-numbers.destroy', $buildingNumber->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Delete</button>
                                                </form>
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

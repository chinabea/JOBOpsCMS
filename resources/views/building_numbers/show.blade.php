
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
                            <h1>Building Number: {{ $buildingNumber->building_number }}</h1>
                            <p>ID: {{ $buildingNumber->id }}</p>
                            <p>Created at: {{ $buildingNumber->created_at }}</p>
                            <p>Updated at: {{ $buildingNumber->updated_at }}</p>
                            <a href="{{ route('building-numbers.index') }}">Back to list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection

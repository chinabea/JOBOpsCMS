@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buildings</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-end">
                        <!-- Link to add a new building number -->
                        <a href="{{ route('building-numbers.create') }}" class="btn btn-info mr-2">
                            <i class="fas fa-plus"></i> Add Building Number
                        </a>
                        <!-- Button to reload the page -->
                        <button class="btn bg-light text-dark border mr-2" onclick="location.reload();">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="my-4 font-weight-bold">Building Details</h2>
                            <div class="mb-3">
                                <h5>Building Name</h5>
                                <p class="font-weight-bold">{{ $buildingNumber->building_number }}</p>
                            </div>
                            <div class="mb-3">
                                <h5>Created at:</h5>
                                <p class="font-weight-bold">{{ $buildingNumber->created_at->format('F j, Y, g:i a') }}</p>
                            </div>
                            <div class="mb-3">
                                <h5>Updated at:</h5>
                                <p class="font-weight-bold">{{ $buildingNumber->updated_at->format('F j, Y, g:i a') }}</p>
                            </div>
                            <!-- Link to go back to the list of building numbers -->
                            <a href="{{ route('building-numbers.index') }}" class="btn btn-secondary mt-3">
                                <i class="fas fa-arrow-left"></i> Back to list
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

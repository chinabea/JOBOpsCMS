@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Office</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-end">
                        <!-- Button to add a new office name -->
                        <a href="{{ route('office-names.create') }}" class="btn btn-info mr-2">
                            <i class="fas fa-plus"></i> Office Name
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
                            <h2>Office Details</h2>
                            <div class="mb-4">
                                <h5>Building Name</h5>
                                <p class="my-4 font-weight-bold">{{ $officeName->office_name }}</p>
                            </div>
                            <div class="mb-2">
                                <h5>Created at:</h5>
                                <p class="font-weight-bold">{{ $officeName->created_at }}</p>
                            </div>
                            <div class="mb-2">
                                <h5>Updated at:</h5>
                                <p class="font-weight-bold">{{ $officeName->updated_at }}</p>
                            </div>
                            <!-- Link to go back to the list of office names -->
                            <a href="{{ route('office-names.index') }}" class="btn btn-secondary mt-3">
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

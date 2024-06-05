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
                            <form action="{{ route('office-names.update', $officeName->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="office_name">Office Name:</label>
                                    <input type="text" class="form-control" name="office_name" id="office_name" value="{{ $officeName->office_name }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

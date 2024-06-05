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
                            <form action="{{ route('building-numbers.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="building_number">Building Name:</label>
                                    <input type="text" class="form-control" name="building_number" id="building_number" value="{{ old('building_number') }}" required>
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

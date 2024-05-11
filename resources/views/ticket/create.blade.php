

@extends('layouts.template')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    .hidden { display: none; }
</style>

<div class="content-wrapper">
    <section class="content-header">
    </section>

    <section class="content">
        <div class="container-fluid mt-5">
            <div class="row align-content-center">


			<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- <form> -->
              <form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="container mt-5">
                        <div class="form-group">
                            <label for="service-location">Service Location</label>
                            <input type="text" name="building_number" class="form-control" placeholder="Enter Building Number or Name"><br>
                            <input type="text" name="office_name" class="form-control" placeholder="Enter Office Name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="description" name="description" class="form-control" placeholder="Enter Description">
                        </div>
                        <div class="form-group">

                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_path" name="file_path">
                                <label class="custom-file-label" for="file_path">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                            </div>
                        </div>
                              


                        <label for="requestType">Request Type:</label>
        <select id="requestType" name="requestType" class="form-control">
            @foreach($requestTypes as $requestType)
            <option value="{{ $requestType->id }}">{{ $requestType->name }}</option>
            @endforeach
        </select>

        <label for="jobType">Job Type:</label>
        <select id="jobType" name="jobType" class="form-control">
            @foreach($jobTypes as $jobType)
            <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
            @endforeach
        </select>

        <label for="equipment">Equipment:</label>
        <select id="equipment" name="equipment" class="form-control">
            @foreach($equipments as $equipment)
            <option value="{{ $equipment->id }}">{{ $equipment->name }}</option>
            @endforeach
        </select>

        <label for="problem">Problem:</label>
        <select id="problem" name="problem" class="form-control">
            @foreach($problems as $problem)
            <option value="{{ $problem->id }}">{{ $problem->name }}</option>
            @endforeach
        </select>


</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!-- 

<script>
        $(document).ready(function () {
            $('#requestType').change(function () {
                var id = $(this).val();
                $('#jobType').empty();
                $.ajax({
                    url: '/api/request-types/' + id + '/job-types',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (key, value) {
                            $('#jobType').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#jobType').change();
                    }
                });
            });

            $('#jobType').change(function () {
                var id = $(this).val();
                $('#equipment').empty();
                $.ajax({
                    url: '/job-types/' + id + '/equipments',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (key, value) {
                            $('#equipment').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#equipment').change();
                    }
                });
            });

            $('#equipment').change(function () {
                var id = $(this).val();
                $('#problem').empty();
                $.ajax({
                    url: '/equipments/' + id + '/problems',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (key, value) {
                            $('#problem').append('<option value="' + value.id + '">' + '</option>');
                        });
                    }
                });
            });

            $('#requestType').change(); // Trigger change to load initial job types
        });
    </script> -->


@endsection





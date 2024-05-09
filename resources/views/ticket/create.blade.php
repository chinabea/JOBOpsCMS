

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
              <form>
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
                                    <!-- <div class="mb-3">
                                        <label for="unitSelection" class="form-label">Select Unit:</label>
                                        <select class="form-select form-control" id="unitSelection">
                                            <option value="">Select a Unit</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jobType" class="form-label">Job Type:</label>
                                        <select class="form-select form-control" id="jobType" disabled>
                                            <option>Select a Job Type</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="problemType" class="form-label">Type of Problem/Equipment Type:</label>
                                        <select class="form-select form-control" id="problemType" disabled>
                                            <option>Select Type</option>
                                        </select>
                                    </div> -->

                                    <div class="mb-3">
    <label for="unitSelection" class="form-label">Select Unit:</label>
    <select class="form-select form-control" id="unitSelection">
        <option value="">Select a Unit</option>
        @foreach ($units as $unit)
            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="jobType" class="form-label">Job Type:</label>
    <select class="form-select form-control" id="jobType" disabled>
        <option>Select a Job Type</option>
        <!-- Options will be added dynamically -->
    </select>
</div>


                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#unitSelection').on('change', function() {
        var unitId = $(this).val();
        $('#jobType').empty().append('<option>Select a Job Type</option>');
        if (unitId) {
            $.ajax({
                url: '/api/job-types/' + unitId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length) {
                        $('#jobType').prop('disabled', false);
                        $.each(data, function(key, value) {
                            $('#jobType').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                }
            });
        } else {
            $('#jobType').prop('disabled', true);
        }
    });

    $('#jobType').on('change', function() {
        var jobId = $(this).val();
        // similar AJAX call to '/api/equipment-types/' + jobId
        // update another dropdown or UI element based on job selection
    });
});
</script>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>





@endsection





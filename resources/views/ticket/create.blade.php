

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














    <!-- submission_form.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Submit Ticket</h2>
        <form method="POST" action="{{ route('units.store') }}">
            @csrf

            <!-- Common fields -->
            <div class="form-group">
                <label for="building_number">Building Number</label>
                <input type="text" class="form-control" id="building_number" name="building_number" required>
            </div>
            <div class="form-group">
                <label for="office_name">Office Name</label>
                <input type="text" class="form-control" id="office_name" name="office_name" required>
            </div>

            <!-- Specific fields for each unit type -->
            <div class="form-group">
                <label for="unit_type">Unit Type</label>
                <select class="form-control" id="unit_type" name="unit_type" required>
                    <option value="NICMU">NICMU</option>
                    <option value="MIS">MIS</option>
                    <option value="ICTRAM">ICTRAM</option>
                </select>
            </div>
            
            <!-- Fields specific to NICMU -->
            <div id="nicmu_fields" style="display: none;">
                <div class="form-group">
                    <label for="nicmu_jobtype">NICMU Job Type</label>
                    <input type="text" class="form-control" id="nicmu_jobtype" name="nicmu_jobtype">
                </div>
                <div class="form-group">
                    <label for="nicmu_equipment">NICMU Equipment</label>
                    <input type="text" class="form-control" id="nicmu_equipment" name="nicmu_equipment">
                </div>
            </div>

            <!-- Fields specific to MIS -->
            <div id="mis_fields" style="display: none;">
                <div class="form-group">
                    <label for="mis_requesttype">MIS Request Type</label>
                    <input type="text" class="form-control" id="mis_requesttype" name="mis_requesttype">
                </div>
                <div class="form-group">
                    <label for="mis_jobtype">MIS Job Type</label>
                    <input type="text" class="form-control" id="mis_jobtype" name="mis_jobtype">
                </div>
                <div class="form-group">
                    <label for="mis_asname">MIS Assigned Name</label>
                    <input type="text" class="form-control" id="mis_asname" name="mis_asname">
                </div>
            </div>

            <!-- Fields specific to ICTRAM -->
            <div id="ictram_fields" style="display: none;">
                <div class="form-group">
                    <label for="ictram_jobtype">ICTRAM Job Type</label>
                    <input type="text" class="form-control" id="ictram_jobtype" name="ictram_jobtype">
                </div>
                <div class="form-group">
                    <label for="ictram_equipment">ICTRAM Equipment</label>
                    <input type="text" class="form-control" id="ictram_equipment" name="ictram_equipment">
                </div>
                <div class="form-group">
                    <label for="ictram_problem">ICTRAM Problem</label>
                    <input type="text" class="form-control" id="ictram_problem" name="ictram_problem">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="ictram_is_warrantry" name="ictram_is_warrantry">
                    <label class="form-check-label" for="ictram_is_warrantry">Is Warrantry</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // Show specific fields based on selected unit type
        $('#unit_type').change(function() {
            var selectedUnit = $(this).val();
            $('#nicmu_fields').hide();
            $('#mis_fields').hide();
            $('#ictram_fields').hide();
            if (selectedUnit === 'NICMU') {
                $('#nicmu_fields').show();
            } else if (selectedUnit === 'MIS') {
                $('#mis_fields').show();
            } else if (selectedUnit === 'ICTRAM') {
                $('#ictram_fields').show();
            }
        });
    </script>
@endsection


@endsection







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
                <div class="card-body">
                    <div class="container mt-5">
                        <div class="form-group">
                            <label for="service-location">Service Location</label>
                            <input type="building_number" name="building_number" class="form-control" placeholder="Enter Building Number or Name"><br>
                            <input type="office_name" name="office_name" class="form-control" placeholder="Enter Office Name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="description" name="description" class="form-control" placeholder="Enter Description">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file_path" class="custom-file-input">
                                <label class="custom-file-label" for="file_path" name="file_path">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="unitSelection" class="form-label">Select Unit:</label>
                            <select class="form-select form-control" id="unitSelection">
                                <option value="">Select a Unit</option>
                                <option value="MICT">MICT</option>
                                <option value="MIS">MIS</option>
                                <option value="ICTRM">ICT Repair and Maintenance</option>
                                <option value="Network">Network</option>
                            </select>
                        </div>
                        <!-- Job Type Selection -->
                        <div class="mb-3">
                            <label for="jobType" class="form-label">Job Type:</label>
                            <select class="form-select form-control" id="jobType" disabled>
                                <option>Select a Job Type</option>
                                <!-- Options will be added dynamically -->
                            </select>
                        </div>
                        <!-- Problem/Equipment Type Selection -->
                        <div class="mb-3">
                            <label for="problemType" class="form-label">Type of Problem/Equipment Type:</label>
                            <select class="form-select form-control" id="problemType" disabled>
                                <option>Select Type</option>
                                <!-- Options will be added dynamically -->
                            </select>
                        </div>
                    </div>
           


<script>
document.getElementById('unitSelection').addEventListener('change', function() {
    var jobType = document.getElementById('jobType');
    var problemType = document.getElementById('problemType');
    jobType.innerHTML = ''; // Clear previous options
    problemType.innerHTML = ''; // Clear previous options

    if (this.value === "ICTRM") {
        jobType.disabled = false;
        jobType.add(new Option("Select a Job Type", ""));
        jobType.add(new Option("Repair", "Repair"));
        jobType.add(new Option("Installation", "Installation"));
        jobType.add(new Option("Software Upgrade", "Software Upgrade"));
        jobType.add(new Option("Preventive Maintenance", "Preventive Maintenance"));
        jobType.add(new Option("Corrective Maintenance", "Corrective Maintenance"));
        jobType.add(new Option("Others", "Others"));

        problemType.disabled = false;
        problemType.add(new Option("Select Type", ""));
        problemType.add(new Option("ICTRAM", "ICTRAM"));
        problemType.add(new Option("All-in-one PC", "All-in-one PC"));
        problemType.add(new Option("System Unit", "System Unit"));
        problemType.add(new Option("Printer", "Printer"));
        problemType.add(new Option("Laptop", "Laptop"));
    } else {
        jobType.disabled = true;
        problemType.disabled = true;
    }
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





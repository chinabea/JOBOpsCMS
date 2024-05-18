@extends('layouts.template')

@section('content')


<div class="content-wrapper">
    <section class="content-header">
        
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ICTRAMs</h1>
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
                            
                            <button type="button" class="btn bg-info" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ictramCreateJobTypeModal">
                                <i class="fas fa-plus"></i> Add Job
                            </button>
                            @include('units.ictram.create-jobType')
                             @include('units.ictram.modal.add-jobType')
            
                            <button type="button" class="btn bg-info float-right mx-1" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ictramCreateEquipmentModal">
                                <i class="fas fa-plus"></i> Add Equipment
                            </button>
                            @include('units.ictram.create-equipment')
                            
                            <button type="button" class="btn bg-info float-right mx-1" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ictramCreateProblemModal">
                                <i class="fas fa-plus"></i> Add Problem or Issue
                            </button>
                            @include('units.ictram.create-problem')

                            @foreach($jobTypes as $jobType)
                                <div class="mb-4">
                                    <h2 class="mb-3">{{ $jobType->jobType_name }}</h2>
                                    <table class="table table-bordered table-sm text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Equipment Name</th>
                                                <th>Problem Description or Issues</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($jobType->equipments as $equipment)
                                                @foreach($equipment->problems as $problem)
                                                    <tr>
                                                        <td>{{ $equipment->equipment_name }}</td>
                                                        <td>{{ $problem->problem_description }}</td>
                                                        <td>{{ $problem->created_at ? $problem->created_at->format('F j, Y g:i A') : 'N/A' }}</td>
                                                        <td>{{ $problem->updated_at ? $problem->updated_at->format('F j, Y g:i A') : 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  
</div> 
@endsection


    <!-- <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>Select Job Type</h3>
                <div class="form-group">
                    <select class="form-select" id="jobTypeSelect">
                        <option value="installation">Installation</option>
                        <option value="repair">Repair</option>
                        <option value="software_upgrade">Software Upgrade</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div class="form-group d-none" id="otherJobTypeInput">
                    <label for="otherJobType">Other Job Type:</label>
                    <input type="text" class="form-control" id="otherJobType" name="otherJobType" placeholder="Enter other job type">
                </div>
            </div>
        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ClXO1TxVvR+abT7xanlJo1A2e9cApvIOYwA4X2FJC7cbtFFJ5v5x2k4jwTfsR/pj" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jobTypeSelect = document.getElementById('jobTypeSelect');
            const otherJobTypeInput = document.getElementById('otherJobTypeInput');

            jobTypeSelect.addEventListener('change', function() {
                if (jobTypeSelect.value === 'others') {
                    otherJobTypeInput.classList.remove('d-none');
                } else {
                    otherJobTypeInput.classList.add('d-none');
                }
            });
        });
    </script> -->


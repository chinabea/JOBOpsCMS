@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title my-1"><i class="fa fa-book"></i> <b>List of ICTRAMS</b></h3>
                            <button type="button" class="btn bg-info color-palette float-right btn-sm" data-toggle="modal"
                                    data-backdrop="static" data-keyboard="false" data-target="#ictramCreateModal">
                                <i class="fas fa-plus"></i> Add ICTRAM
                            </button>
                            @include('unit.ictram.create')
                        </div>
                        <div class="card-body">
                                <table class="table table-sm table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Unit</th>
                                            <th>Job Type</th>
                                            <th>Equipment</th>
                                            <th>Problem</th>
                                            <th>is_warrantry</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ictrams as $ictram)
                                        <tr>
                                            <td>{{ $ictram->id }}</td>
                                            <td>{{ $ictram->unit }}</td>
                                            <td>{{ $ictram->jobtype }}</td>
                                            <td>{{ $ictram->equipment }}</td>
                                            <td>{{ $ictram->problem }}</td>
                                            <td>{{ $ictram->is_warrantry ? 'Yes' : 'No' }}</td>
                                            <td>{{ $ictram->created_at }}</td>
                                            <td>{{ $ictram->updated_at }}</td>
                                            <td>
                                                <div class="item form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="btn-group">
                                                            <button type="button" class="preview-version btn btn-sm btn-secondary" data-toggle="modal" data-target="#ictramShowModal{{ $ictram->id }}" data-backdrop="static" data-keyboard="false">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            @include('unit.ictram.show')
                                                            <button class="btn btn-sm btn-warning" onclick="openEditModal('{{ $ictram->id }}')">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <form id="delete-form-{{ $ictram->id }}" action="{{ route('ictrams.destroy', $ictram->id) }}" method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <!-- Change the delete button to a regular button and add onclick event -->
                                                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $ictram->id }}')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



































    <div class="container mt-5">
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

    <!-- Bootstrap Bundle with Popper -->
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
    </script>

















</div> 
@endsection

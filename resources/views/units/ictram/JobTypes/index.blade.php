@extends('layouts.template')

@section('content')


<div class="content-wrapper">
    <section class="content-header">
        
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ICTRAMs Job Types</h1>
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
                             @include('units.ictram.modal.create-jobType')
                            <div class="d-flex fex-row justify-content-end mb-2">
                            <button type="button" class="btn btn-sm bg-info" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ictramCreateJobTypeModal">
                                <i class="fas fa-plus"></i> Add Job Type
                            </button>
                            </div>
                                <div class="mb-4">
                                    <table class="table table-bordered table-sm text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Job type Name</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            @foreach($jobTypes as $jobType)
                                                    <tr>
                                                        <td>{{ $jobType->jobType_name }}</td>
                                                        <td>{{ $jobType->created_at ? $jobType->created_at->format('F j, Y g:i A') : 'N/A' }}</td>
                                                        <td>{{ $jobType->updated_at ? $jobType->updated_at->format('F j, Y g:i A') : 'N/A' }}</td>
                                                     <td>
                                                        <!-- <button class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></button> -->
                                                        @include('units.ictram.modal.edit-equipment')
                                                        @include('units.ictram.modal.delete-equipment')
                                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ictramEditJobTypeModal{{ $jobType->id }}"><i class="fas fa-pen"></i></button>
                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ictramDeleteJobTypeModal{{ $jobType->id }}"><i class="fas fa-trash"></i></button>
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
        </div>
    </div>
</section>  
</div> 
@endsection
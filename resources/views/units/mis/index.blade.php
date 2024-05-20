@extends('layouts.template')

@section('content')


<div class="content-wrapper">
    <section class="content-header">
        
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">MISes Assignation</h1>
          </div>
        </div>
      </div>

    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card px-3 pt-3 pb-1">
                        @include('units.mis.modal.create-jobType')
                        @include('units.mis.modal.create-request-type')
                        @include('units.mis.modal.create-asName')
                        <form id="jobForm" action="{{ route('mises.add-relation') }}" method="POST">
                                @csrf
                            <div class="d-md-flex flex-md-row flex-column justify-content-between gap-3">
                            <div class="mx-2 w-100">
                                <div class="d-flex flex-row justify-content-between align-items-center mb-1 mt-2">
                                    <label for="jobType">Request Type</label>
                                    <div>
                                    <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ictramCreateJobTypeModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <select name="ictram_job_type_id" id="ictram_job_type_id" class="selectpicker form-control" data-live-search="true" required>
                                    <option value="" disabled selected>Select Job Type</option>
                                        @foreach($jobTypes as $jobType)
                                            <option value="{{ $jobType->id }}">{{ $jobType->jobType_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mx-2 w-100">
                                <div class="d-flex flex-row justify-content-between align-items-center mb-1 mt-2">
                                    <label for="requestType">Request Type</label>
                                    <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ictramCreateEquipmentModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="dropdown">
                                    <select name="mis_request_type_id" id="mis_request_type_id" class="selectpicker form-control" data-live-search="true" required>
                                    <option value="" disabled selected>Select Request Type</option>
                                        @foreach($requestTypes as $requestType)
                                            <option value="{{ $requestType->id }}">{{ $requestType->requestType_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mx-2 w-100">
                                <div class="d-flex flex-row justify-content-between align-items-center mb-1 mt-2">
                                    <label for="asName">AsName</label>
                                    <div>
                                    <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ictramCreateProblemModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <select name="mis_asName_id" id="mis_asName_id" class="selectpicker form-control" data-live-search="true" required>
                                        @foreach ($asNames as $asName)
                                        <option value="{{ $asName->id }}">{{ $asName->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="d-flex flex-row justify-content-end mx-2 mt-3">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-check"></i> Save
                            </button>
                            </div>
                        </form>
                    </div>
            <table id="datatable-responsive" class="table table-bordered table-hover text-center table-sm">
                <tbody>
                    @foreach ($sortedMises->groupBy('requestTypeName.requestType_name') as $requestTypeName => $mises)
                        <tr>
                            <th class="bg-info py-2" colspan="4">{{ $requestTypeName }}</th>
                        </tr>
                        <tr>
                            <th>Equipment</th>
                            <th>Problem</th>
                            <th width="7%">Action</th>
                        </tr>
                        @foreach ($mises as $index => $mis)
                            <tr>
                                <td>{{ $mis->jobType->jobType_name }}</td>
                                <td>{{ $mis->asName->name }}</td>
                                <td>
                                    @include('units.mis.modal.delete-dataWithRelation')
                                    <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#misDeletedataWithRelationModal{{ $mis->id }}" style="opacity: 0.8;"><i class="fas fa-trash text-red"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</section>  
</div> 
@endsection

<style>
    .scrollable-menu {
        max-height: 250px;
        overflow-y: auto;
    }
</style>
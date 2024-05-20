@extends('layouts.template')

@section('content')


<div class="content-wrapper">
    <section class="content-header">
        
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">MISes Request Types</h1>
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
                            @include('units.mis.modal.create-request-type')
                            <div class="d-flex fex-row justify-content-end mb-2">
                            <button type="button" class="btn btn-sm bg-info" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#misCreateRequestTypeModal">
                                <i class="fas fa-plus"></i> Add Request Type
                            </button>
                            </div>

                                <div class="mb-4">
                                    <table class="table table-bordered table-sm text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Request Type Name</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            @foreach($requestTypes as $requestType)
                                                    <tr>
                                                        <td>{{ $requestType->requestType_name }}</td>
                                                        <td>{{ $requestType->created_at ? $requestType->created_at->format('F j, Y g:i A') : 'N/A' }}</td>
                                                        <td>{{ $requestType->updated_at ? $requestType->updated_at->format('F j, Y g:i A') : 'N/A' }}</td>
                                                        <td>
                                                            @include('units.mis.modal.edit-request-type')
                                                            @include('units.mis.modal.delete-request-type')
                                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#misEditEquipmentModal{{ $requestType->id }}"><i class="fas fa-pen"></i></button>
                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#misDeleteEquipmentModal{{ $requestType->id }}"><i class="fas fa-trash"></i></button>
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
@extends('layouts.template')

@section('content')


<div class="content-wrapper">
    <section class="content-header">
        
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ICTRAMs Equipments</h1>
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


                                <div class="mb-4">
                                    <table class="table table-bordered table-sm text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Equipment Name</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            @foreach($equipments as $equipment)
                                                    <tr>
                                                        <td>{{ $equipment->equipment_name }}</td>
                                                        <td>{{ $equipment->created_at ? $equipment->created_at->format('F j, Y g:i A') : 'N/A' }}</td>
                                                        <td>{{ $equipment->updated_at ? $equipment->updated_at->format('F j, Y g:i A') : 'N/A' }}</td>
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
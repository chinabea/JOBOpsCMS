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
</div> 
@endsection

@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Office Names</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('office-names.create') }}" class="btn btn-info mr-2">
                            <i class="fas fa-plus"></i> Office Name
                        </a>
                        <button class="btn bg-light text-dark border mr-2" onclick="location.reload();">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
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
                            <div class="mb-4">
                            </div>
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Office Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($officeNames as $officeName)
                                    <tr>
                                        <td>{{ $officeName->id }}</td>
                                        <td>{{ $officeName->office_name }}</td>
                                        <td>
                                            <a href="{{ route('office-names.show', $officeName->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Show
                                            </a>
                                            <a href="{{ route('office-names.edit', $officeName->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('office-names.destroy', $officeName->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
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

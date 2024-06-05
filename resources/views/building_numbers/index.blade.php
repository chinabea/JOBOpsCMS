@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buildings</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-end">
                        <!-- Link to add a new building number -->
                        <a href="{{ route('building-numbers.create') }}" class="btn btn-info mr-2">
                            <i class="fas fa-plus"></i> Add Building Number
                        </a>
                        <!-- Button to reload the page -->
                        <button class="btn bg-light text-dark border mr-2" onclick="location.reload();">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-4"></p>
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Building Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buildingNumbers as $buildingNumber)
                                        <tr>
                                            <td>{{ $buildingNumber->id }}</td>
                                            <td>{{ $buildingNumber->building_number }}</td>
                                            <td>
                                                <!-- Show, Edit, and Delete actions for each building number with icons -->
                                                <a href="{{ route('building-numbers.show', $buildingNumber->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Show
                                                </a>
                                                <a href="{{ route('building-numbers.edit', $buildingNumber->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('building-numbers.destroy', $buildingNumber->id) }}" method="POST" style="display:inline;">
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



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
                        <div class="card-body">
                            <div class="container">
                                <h1>Add Unit Type</h1>
                                <form method="POST" action="{{ route('units.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title my-1"><i class="fa fa-book"></i> <b>List of Units</b></h3> <br><br>
                            <div class="container">
                                <table class="table table-sm" id="example1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($units as $unit)
                                        <tr>
                                            <td>{{ $unit->id }}</td>
                                            <td>{{ $unit->name }}</td>
                                            <td>{{ $unit->created_at }}</td>
                                            <td>{{ $unit->updated_at }}</td>
                                            <td>
                                                <div class="item form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-sm btn-secondary" onclick="openShowModal('{{ $unit->id }}')">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-warning" onclick="openEditModal('{{ $unit->id }}')">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form id="delete-form-{{ $unit->id }}" action="{{ route('units.destroy', $unit->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <!-- Change the delete button to a regular button and add onclick event -->
                                                        <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $unit->id }}')">
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
        </div>
    </section>
</div> 

<!-- Define the show modal -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">Unit Details</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="showName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="showName" name="name" value="{{ $unit->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="showCreatedAt" class="form-label">Created Date</label>
                    <input type="text" class="form-control" id="showCreatedAt" name="name" value="{{ $unit->created_at }}" readonly>
                </div>
                <!-- Add other fields as needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openShowModal(unitId) {
        // Populate the form fields with unit details
        var unit = @json($unit);
        document.getElementById('showName').value = unit.name;
        document.getElementById('showCreatedAt').value = unit.created_at;

        // Show the modal
        var modal = new bootstrap.Modal(document.getElementById('showModal'));
        modal.show();
    }
</script>


<!-- Define the edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Unit</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" action="{{ route('units.update', $unit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" value="{{ $unit->name }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(unitId) {
        // Populate the form fields with current unit details
        var unit = @json($unit);
        document.getElementById('editName').value = unit.name;

        // Set the action attribute of the form to the correct route for updating the unit
        var form = document.getElementById('editForm');
        form.action = '{{ route('units.update', '') }}/' + unitId;

        // Show the modal
        var modal = new bootstrap.Modal(document.getElementById('editModal'));
        modal.show();
    }
</script>
@endsection

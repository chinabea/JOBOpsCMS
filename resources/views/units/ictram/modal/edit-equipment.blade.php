<!-- Edit Job Type Modal -->
<div class="modal fade" id="ictramEditEquipmentModal{{ $equipment->id }}" tabindex="-1" role="dialog" aria-labelledby="ictramEditEquipmentModal{{ $equipment->id }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ictramEditEquipmentModal{{ $equipment->id }}Label">Edit Job Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editEquipmentForm{{ $equipment->id }}" action="{{ route('ictrams.editEquipment', $equipment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="edit_equipment_name">Job Type Name</label>
                        <input type="text" class="form-control" id="edit_equipment_name" name="edit_equipment_name" value="{{ $equipment->equipment_name }}" required>
                    </div>
                    <!-- Add more input fields for other attributes if needed -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

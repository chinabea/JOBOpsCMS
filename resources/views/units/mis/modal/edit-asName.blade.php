<!-- Edit Job Type Modal -->
<div class="modal fade" id="misEditAsNameModal{{ $asName->id }}" tabindex="-1" role="dialog" aria-labelledby="misEditAsNameModal{{ $asName->id }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="misEditAsNameModal{{ $asName->id }}Label">Edit Account Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editAsNameForm{{ $asName->id }}" action="{{ route('mises.editAsName', $asName->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="edit_as_name">Account Name</label>
                        <input type="text" class="form-control" id="edit_as_name" name="edit_as_name" value="{{ $asName->name }}" required>
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

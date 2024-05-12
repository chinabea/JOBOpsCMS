<div class="modal fade" id="ictramCreateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add ICTRAM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('ictrams.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" value="ICTRAM-ICT Repair and Management" required disabled>
                    </div>
                    
                    <div class="form-group">
                        <label for="jobtype">Job Type</label>
                        <input type="text" class="form-control" id="jobtype" name="jobtype" required>
                    </div>
                    <div class="form-group">
                        <label for="equipment">Equipment</label>
                        <input type="text" class="form-control" id="equipment" name="equipment" required>
                    </div>
                    <div class="form-group">
                        <label for="problem">Problem</label>
                        <input type="text" class="form-control" id="problem" name="problem" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_warrantry" name="is_warrantry">
                        <label class="form-check-label" for="is_warrantry">Is Warrantry</label>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
                </form>
        </div>
    </div>
</div>

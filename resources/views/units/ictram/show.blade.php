<div class="modal fade" id="ictramShowModal{{ $jobType->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ICTRAM Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="showUnit">Unit</label>
                    <input type="text" class="form-control" id="showUnit" name="unit" value="ICTRAM-ICT Repair and Management" readonly>
                </div>
                
                <div class="form-group">
                    <label for="showJobtype">Job Type</label>
                    <input type="text" class="form-control" id="showJobtype" name="jobtype" value="{{ $jobType->jobtype }}" readonly>
                </div>
                <div class="form-group">
                    <label for="showEquipment">Equipment</label>
                    <input type="text" class="form-control" id="showEquipment" name="equipment" value="{{ $jobType->equipment }}" readonly>
                </div>
                <div class="form-group">
                    <label for="showProblem">Problem</label>
                    <input type="text" class="form-control" id="showProblem" name="problem" value="{{ $jobType->problem }}" readonly>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

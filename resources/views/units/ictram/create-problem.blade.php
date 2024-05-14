

<div class="modal fade" id="ictramCreateProblemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Problems or Issues</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="jobForm" action="{{ route('ictrams.storeProblem') }}" method="POST">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                    
    <div class="form-group">
        <label for="ictram_equipment_id">Equipment</label>
        <select name="ictram_equipment_id" id="ictram_equipment_id" class="form-control" required>
            @foreach($equipments as $equipment)
                <option value="{{ $equipment->id }}">{{ $equipment->equipment_name }}</option>
            @endforeach
        </select>
    </div>

                    <div class="mb-3">
                        <label for="equipment">Problem Description</label>
                            <input type="text" class="form-control" id="problem_description" name="problem_description" placeholder="Enter Description">
                    
                    </div>
                    
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

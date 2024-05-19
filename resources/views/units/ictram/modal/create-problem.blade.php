

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
                    <div class="mb-3">
                        <label for="equipment">Problem Description</label>
                            <input type="text" class="form-control" id="problem_description" name="problem_description" placeholder="Enter Description" required>
                    
                    </div>
                    
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add equipment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

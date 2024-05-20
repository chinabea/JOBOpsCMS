

<div class="modal fade" id="ictramCreateProblemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
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
                <div class="form-group row" id="problem-description-area">
                    <label for="problem_description" class="col-sm-2 col-form-label">Problem Description</label>
                    <div class="col-sm-10">
                        <div id="dynamic-problem-description">
                            <!-- Placeholder for existing problem descriptions -->
                            @if(!empty($existingProblemDescriptions))
                                @foreach($existingProblemDescriptions as $description)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="problem_description[]" placeholder="Enter Description" value="{{ $description }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" type="button" onclick="removeProblemDescription(this)">-</button>
                                        </div>
                                    </div>
                                @endforeach
                            
                            @endif
                            <!-- New problem description entry field -->
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="problem_description[]" placeholder="Enter Description" required>
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" onclick="addProblemDescription()">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
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

<script>
function addProblemDescription() {
    var newField = `
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="problem_description[]" placeholder="Enter Description" required>
            <div class="input-group-append">
                <button class="btn btn-danger" type="button" onclick="removeProblemDescription(this)">-</button>
            </div>
        </div>`;
    document.getElementById('dynamic-problem-description').insertAdjacentHTML('beforeend', newField);
}

function removeProblemDescription(button) {
    button.closest('.input-group').remove();
}
</script>
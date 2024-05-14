<!-- ictramCreateModal.blade.php -->

<div class="modal fade" id="ictramCreateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Job Types, Equipments, and Problems</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="jobForm" action="{{ route('ictrams.storeIctram') }}" method="POST">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="mb-3">
                        <label for="jobType">Job Type</label>
                        @if($jobTypes->count() > 0)
                            <select class="form-control" id="jobType" name="ictram_job_type_id">
                                <option value="">Select Job Type</option>
                                @foreach($jobTypes as $jobType)
                                    <option value="{{ $jobType->id }}">{{ $jobType->jobType_name }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" class="form-control" id="jobType_name" name="jobType_name" placeholder="Enter job type">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="equipment">Equipment</label>
                        @if($equipments->count() > 0)
                            <select class="form-control" id="equipment" name="equipment_name">
                                <option value="">Select Equipment</option>
                                @foreach($equipments as $equipment)
                                    <option value="{{ $equipment->id }}">{{ $equipment->equipment_name }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" class="form-control" id="equipment_name" name="equipment_name" placeholder="Enter equipment">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="problem">Problem</label>
                            <input type="text" class="form-control" id="problem_description" name="problem_description" placeholder="Enter problem or issues">
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

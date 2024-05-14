

<div class="modal fade" id="ictramCreateEquipmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Equipments</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="jobForm" action="{{ route('ictrams.storeEquipment') }}" method="POST">
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
                            <input type="text" class="form-control" id="equipment_name" name="equipment_name" placeholder="Enter equipment">
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

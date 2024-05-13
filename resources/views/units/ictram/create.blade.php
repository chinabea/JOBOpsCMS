<div class="modal fade" id="ictramCreateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Job Types and Equipments</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="jobForm" action="{{ route('ictram.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id">User ID:</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter user ID">
                    </div>
                    <div class="mb-3">
                        <label for="ictram_job_type_id">Job Type ID:</label>
                        <input type="text" class="form-control" id="ictram_job_type_id" name="ictram_job_type_id" placeholder="Enter job type ID">
                    </div>
                    <div class="mb-3">
                        <label for="ictram_equipment_id">Equipment ID:</label>
                        <input type="text" class="form-control" id="ictram_equipment_id" name="ictram_equipment_id" placeholder="Enter equipment ID">
                    </div>
                    <div class="mb-3">
                        <label for="ictram_problem_id">Problem ID:</label>
                        <input type="text" class="form-control" id="ictram_problem_id" name="ictram_problem_id" placeholder="Enter problem ID">
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

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ClXO1TxVvR+abT7xanlJo1A2e9cApvIOYwA4X2FJC7cbtFFJ5v5x2k4jwTfsR/pj" crossorigin="anonymous"></script>

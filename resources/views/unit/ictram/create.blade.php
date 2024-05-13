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
                <form id="jobForm" action="#" method="POST">
                    <div class="mb-3">
                        <label for="jobType">Job Type:</label>
                        <input type="text" class="form-control" id="jobType" name="jobType" placeholder="Enter job type">
                    </div>
                    <div class="mb-3">
                        <label for="equipment">Equipment:</label>
                        <input type="text" class="form-control" id="equipment" name="equipment" placeholder="Enter equipment">
                    </div>
                    <div class="mb-3">
                        <label for="problems">Problems (optional):</label>
                        <input type="text" class="form-control" id="problems" name="problems" placeholder="Enter problems">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="addJobType()">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ClXO1TxVvR+abT7xanlJo1A2e9cApvIOYwA4X2FJC7cbtFFJ5v5x2k4jwTfsR/pj" crossorigin="anonymous"></script>
<script>
    function addJobType() {
        const jobType = document.getElementById('jobType').value;
        const equipment = document.getElementById('equipment').value;
        const problems = document.getElementById('problems').value;

        // Create job type card
        const jobTypeCard = document.createElement('div');
        jobTypeCard.classList.add('card', 'mb-3');
        jobTypeCard.innerHTML = `
            <div class="card-header">
                <h5 class="card-title">${jobType}</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Equipment: ${equipment}</p>
                <p class="card-text">Problems: ${problems}</p>
            </div>
        `;

        // Append job type card to container
        document.getElementById('jobTypesContainer').appendChild(jobTypeCard);

        // Clear form fields
        document.getElementById('jobType').value = '';
        document.getElementById('equipment').value = '';
        document.getElementById('problems').value = '';
    }
</script>
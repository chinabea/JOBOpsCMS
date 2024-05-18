<div class="modal fade" id="ictramCreateJobTypeModal222" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2222">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Add Job Types</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="jobForm" action="{{ route('ictrams.storeJobType') }}" method="POST">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="mb-3">
                        <label for="jobType">Job Type</label>
                            <input type="text" class="form-control" id="jobType_name" name="jobType_name" placeholder="Enter job type">
                     
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                        <button type="submit" class="btn btn-primary">Add equipment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function submitForm() {
    var formData = $('#jobForm').serialize(); // Serialize form data
    
    $.ajax({
        type: 'POST',
        url: $('#jobForm').attr('action'), // Get form action URL
        data: formData, // Form data
        success: function(response) {
            // Handle success response
            console.log(response);
            $('#ictramCreateJobTypeModal222').modal('hide'); // Close modal
            // You can optionally update the page content here without reloading
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error(xhr.responseText);
        }
    });
}
</script>
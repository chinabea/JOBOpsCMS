<div class="modal fade" id="createFaqModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add FAQ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store.faq') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" name="question" id="question" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea id="create_answer" name="answer" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

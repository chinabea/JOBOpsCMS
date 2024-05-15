
<div class="modal fade" id="createFaqModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add FAQ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store.faq') }}" method="post">
                    @csrf
                    <label for="question">Question</label><br>
                    <input class="form-control" name="question" id="question" required><br>

                    <label for="answer">Answer</label><br>
                    <textarea id="summernote" class="summernote" name="answer" required></textarea><br>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-upload"></i>
                        <span>Submit</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

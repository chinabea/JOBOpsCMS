<div class="modal fade" id="editFaqModal{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="editFaqModalLabel{{ $faq->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFaqModalLabel{{ $faq->id }}">Edit FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit FAQ form -->
                <form action="{{ route('edit.faq', $faq->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <label for="">Questions</label> <br>
                    <input class="form-control" name="question" id="question" value="{{ $faq->question }}" ></input><br>

                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea id="answer" name="answer" class="form-control">{!! $faq->answer !!}</textarea>
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

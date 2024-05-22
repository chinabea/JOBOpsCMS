<div class="modal fade" id="showFaqModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">FAQ Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="question">Question</label>
                    <input type="text" class="form-control" id="question" value="{{ $faq->question }}" readonly>
                </div>
                
                <div class="form-group">
                    <label for="answer">Answer</label>
                    <textarea id="answer" class="form-control" readonly>{!! $faq->answer !!}</textarea>
                </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

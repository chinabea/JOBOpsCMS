<form action="{{ route('edit.faq', $faq->id) }}" method="post">
    @csrf
    @method('PUT')
    
    <label for="">Unit</label> <br>
    <input name="question" id="question" value="{{ $faq->question }}" ></input><br>

    <label for="">Request</label> <br>
    <input name="answer" id="answer" value="{{ $faq->answer }}" ></input><br>

    <button type="submit" class="btn btn-primary col start" name="submit_project">
        <i class="fas fa-upload"></i>
        <span>Submit</span>
    </button>

</form>
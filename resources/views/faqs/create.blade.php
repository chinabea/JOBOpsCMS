
<form action="{{ route('store.faq') }}" method="post">
    @csrf

    <label for="">Question</label> <br>
    <textarea name="question" id="question" required></textarea><br>

    <label for="">Answer</label> <br>
    <textarea name="answer" id="answer" required></textarea><br>

    <button type="submit" class="btn btn-primary col start" name="submit_project">
        <i class="fas fa-upload"></i>
        <span>Submit</span>
    </button>

</form>
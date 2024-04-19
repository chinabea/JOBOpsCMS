
<form action="{{ route('store.ticket') }}" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

    <label for="">Unit</label> <br>
    <textarea name="unit" id="unit" required></textarea><br>

    <label for="">Request</label> <br>
    <textarea name="request" id="request" required></textarea><br>

    <label for="">Description</label> <br>
    <textarea name="description" id="description" required></textarea><br>

    <button type="submit" class="btn btn-primary col start" name="submit_project">
        <i class="fas fa-upload"></i>
        <span>Submit</span>
    </button>

</form>
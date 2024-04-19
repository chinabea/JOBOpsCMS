<form action="{{ route('edit.ticket', $ticket->id) }}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

    <label for="">Unit</label> <br>
    <input name="unit" id="unit" value="{{ $ticket->unit }}" ></input><br>

    <label for="">Request</label> <br>
    <input name="request" id="request" value="{{ $ticket->request }}" ></input><br>

    <label for="">Description</label> <br>
    <input name="description" id="description" value="{{ $ticket->description }}"></input><br>

    <button type="submit" class="btn btn-primary col start" name="submit_project">
        <i class="fas fa-upload"></i>
        <span>Submit</span>
    </button>

</form>
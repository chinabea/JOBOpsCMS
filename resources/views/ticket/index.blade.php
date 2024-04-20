
<form action="{{ route('generate.tickets.report') }}" method="post">
    @csrf
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date">
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date">
    <button type="submit">Export</button>
</form>

                        <!-- ------------------------------------------------------------------------ -->
<table id="example1" class="table table-bordered table-hover text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>Unit</th>
            <th>Request</th>
            <th>Description</th>
            <th>Action(s)</th>
        </tr>
    </thead>
    <tbody>
        @if($tickets->count() > 0)
        @foreach($tickets as $ticket)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td class="align-middle">{{ $ticket->unit }}</td>
            <td class="align-middle">{{ $ticket->request }}</td>
            <td class="align-middle">{{ $ticket->description }}</td>
            <td class="align-middle">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <a href="{{ route('update.ticket', $ticket->id) }}" type="button"
                        class="btn btn-warning">
                        <i class="fas fa-edit">Edit</i>
                    </a>
                    <button class="btn btn-danger" onclick="confirmDelete('{{ route('destroy.ticket', $ticket->id) }}')">
                        <i class="fas fa-trash">Delete</i>
                    </button>
                    </div>
                <div class="btn-group align-middle" role="group" aria-label="Basic example">
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Unit</th>
            <th>Request</th>
            <th>Description</th>
            <th>Action(s)</th>
        </tr>
    </tfoot>
</table>


<script>
function confirmDelete(url) {
    if (confirm('Are you sure you want to delete this record?')) {
    // Create a hidden form and submit it programmatically
    var form = document.createElement('form');
    form.action = url;
    form.method = 'POST';
    form.innerHTML = '@csrf @method("delete")';
    document.body.appendChild(form);
    form.submit();
    }
}
</script>
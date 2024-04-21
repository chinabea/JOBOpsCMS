
<br><br>
<form action="{{ route('generate.faqs.report') }}" method="post">
    @csrf
    <div class="row align-items-center">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="start_date">Start Date:</label>
                    <input type="date" class="form-control" name="start_date" id="start_date">
                </div>
                <div class="col-md-6">
                    <label for="end_date">To:</label>
                    <input type="date" class="form-control" name="end_date" id="end_date">
                </div>
            </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Actions</label>
                <div>
                    <button type="button" id="reset" class="btn btn-warning"><i class="fa fa-sync"></i> </button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-file-pdf"></i> Generate PDF</button>
                </div>
            </div>
        </div>
    </div>
</form>
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
        @if($faqs->count() > 0)
        @foreach($faqs as $faq)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td class="align-middle">{{ $faq->question }}</td>
            <td class="align-middle">{{ $faq->answer }}</td>
            <td class="align-middle">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <a href="{{ route('update.faq', $faq->id) }}" type="button"
                        class="btn btn-warning">
                        <i class="fas fa-edit">Edit</i>
                    </a>
                    <button class="btn btn-danger" onclick="confirmDelete('{{ route('destroy.faq', $faq->id) }}')">
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
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
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
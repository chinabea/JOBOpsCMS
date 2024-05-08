<form method="POST" action="{{ route('jobs.store') }}">
    @csrf
    <label for="unit_id">Unit:</label>
    <select name="unit_id" id="unit_id" required>
        @foreach($units as $unit)
            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
        @endforeach
    </select>

    <label for="name">Job Type Name:</label>
    <input type="text" name="name" id="name" required>

    <button type="submit">Add Job Type</button>
</form>


<form action="{{ route('user.edit', $user->id) }}" method="post">
    @csrf
    @method('PUT')
    <label for="inputText">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->first_name }} {{ $user->last_name }}">
        <br>
        <label for="inputText">Email</label>
        <input type="text" class="form-control"  id="email" name="email" value="{{ $user->email }}">
        <br>
        <label for="">Role</label>
        <input type="text" class="form-control" id="role" name="role" value="{{ $user->role }}">
        <br>
    <button type="submit" class="btn btn-warning">Update</button>
    <br>
</form>
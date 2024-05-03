<form action="{{ route('user.saveProfile') }}" method="POST">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" readonly>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" readonly>
    </div>
    <div>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required>
    </div>
    <div class="form-group row">
        <label for="inputExperience" class="col-sm-2 col-form-label">Role</label>
        <div class="col-sm-10">
            <select class="form-control" name="role" required>
                    <option value="" selected disabled>Please select a role</option>
                    <option value="1" type="Admin" id="1" name="1">Admin</option>
                    <option value="2" type="MICT Staff" id="2" name="2">MICT Staff</option>
                    <option value="3" type="Staff" id="3" name="3">Staff</option>
            </select>
        </div>
    </div>
    <div>
        <label for="job_position">Job Position:</label>
        <input type="text" id="job_position" name="job_position" required>
    </div>
    <div>
        <label for="expertise">Expertise:</label>
        <input type="text" id="expertise" name="expertise" required>
    </div>
    <button type="submit">Save Profile</button>
</form>


@extends('layouts.guest-template')

@section('content')

<section id="pricing" class="pricing">
  <div class="container">
    <div class="row no-gutters justify-content-center mt-5">

    <section id="contact" class="contact">
      <div class="container aos-init aos-animate" data-aos="fade-up">
        <header class="section-header">
          <p>Contact Us</p>
        </header>
        <div class="row gy-4">
          <form action="{{ route('user.saveProfile') }}" method="POST">
            @csrf
            
            <div class="form-group mt-3">
                <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" disabled>
            </div>
              <div class="form-group mt-3">
                <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}" disabled>
            </div>
              <div class="form-group mt-3">
                <input placeholder="Phone Number" class="form-control" type="text" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group mt-3">
              <select class="form-control" name="role" required>
                <option value="" selected disabled>Select your Role</option>
                <option value="1" type="Director" id="1" name="1">Director</option>
                <option value="2" type="ICTRAM Head" id="2" name="2">ICTRAM Head</option>
                <option value="3" type="NICMU Head" id="3" name="3">NICMU Head</option>
                <option value="4" type="MIS Head" id="4" name="4">MIS Head</option>
                <option value="5" type="Staff" id="5" name="5">Staff</option>
                <option value="6" type="Student" id="6" name="6">Student</option>
                <option value="7" type="ICTRAM Staff" id="7" name="7">ICTRAM Staff</option>
                <option value="8" type="NICMU Staff" id="8" name="8">NICMU Staff</option>
                <option value="9" type="MIS Staff" id="9" name="9">MIS Staff</option>
              </select>
            </div>
            <!-- <div class="form-group mt-3">
                <input placeholder="Job Position" class="form-control" type="text" id="job_position" name="job_position" required>
            </div>
            <div class="form-group mt-3" id="expertise-area">
              <div id="dynamic-expertise">
                  <div class="input-group mb-2">
                      <input type="text" class="form-control" name="expertise[]" placeholder="Enter expertise">
                      <div class="input-group-append">
                        <button class="btn btn-success" type="button" onclick="addExpertise()">+</button>
                      </div>
                </div>
              </div>
            </div> -->
            <br><br>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Save Profile and Request</button>
            </div>
          </form>
        </div>
      </div>
    </section>
    </div>
  </div>
</section>

<script>
function addExpertise() {
    var container = document.getElementById('dynamic-expertise');
    var input = document.createElement('div');
    input.classList.add('input-group', 'mb-2');
    input.innerHTML = `
        <input type="text" class="form-control" name="expertise[]" placeholder="Enter expertise">
        <div class="input-group-append">
            <button class="btn btn-danger" type="button" onclick="removeExpertise(this)">-</button>
        </div>`;
    container.appendChild(input);
}

function removeExpertise(button) {
    var group = button.closest('.input-group');
    group.parentNode.removeChild(group);
}

</script>

@endsection

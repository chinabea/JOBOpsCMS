
@extends('layouts.guest-template')

@section('content')

<section id="pricing" class="pricing">
  <div class="container">
    <div class="row no-gutters justify-content-center mt-5">

      <div class="col-lg-8 box featured" data-aos="fade-up">
        <h4>Setup your Profile</h4>
        <ul>
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
                <option value="1" type="Admin" id="1" name="1">Admin</option>
                <option value="2" type="MICT Staff" id="2" name="2">MICT Staff</option>
                <option value="3" type="Staff" id="3" name="3">Staff</option>
              </select>
            </div>
            <div class="form-group mt-3">
                <input placeholder="Job Position" class="form-control" type="text" id="job_position" name="job_position" required>
            </div>
            <div class="form-group mt-3" id="expertise-area">
              <div id="dynamic-expertise">
                  <!-- New expertise entry field -->
                  <div class="input-group mb-2">
                      <input type="text" class="form-control" name="expertise[]" placeholder="Enter expertise">
                      <div class="input-group-append">
                        <button class="btn btn-success" type="button" onclick="addExpertise()">+</button>
                      </div>
                </div>
              </div>
            </div>

            
            <br><br>
            <div class="text-center">
              <button type="submit" class="get-started-btn">Save Profile and Request</button>
            </div>

        </form>
        </ul>
      </div>
      
    </div>

  </div>
</section>
<!-- End Pricing Section -->



        

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

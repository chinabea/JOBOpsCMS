
@extends('layouts.guest-template')

@section('content')

<section id="pricing" class="pricing">
  <div class="container">
    <div class="row no-gutters justify-content-center">

      <div class="col-lg-8 box featured" data-aos="fade-up">
        <h4>Setup your Profile</h4>
        <ul>
          <form action="{{ route('user.saveProfile') }}" method="POST">
            @csrf
              <div class="form-group mt-3">
                <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" readonly>
            </div>
              <div class="form-group mt-3">
                <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}" readonly>
            </div>
              <div class="form-group mt-3">
                <input placeholder="Phone Number" class="form-control" type="text" id="phone_number" name="phone_number" required>
            </div>
              <div class="form-group mt-3">
                <div class="col-sm-10">
                    <select class="form-control" name="role" required>
                            <option value="" selected disabled>Select your Role</option>
                            <option value="1" type="Admin" id="1" name="1">Admin</option>
                            <option value="2" type="MICT Staff" id="2" name="2">MICT Staff</option>
                            <option value="3" type="Staff" id="3" name="3">Staff</option>
                    </select>
                </div>
            </div>
              <div class="form-group mt-3">
                <input placeholder="Job Position" class="form-control" type="text" id="job_position" name="job_position" required>
            </div>
              <div class="form-group mt-3">
                <input  placeholder="Expertise" class="form-control" type="text" id="expertise" name="expertise" required>
            </div><br><br>
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

@endsection

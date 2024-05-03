@extends('layouts.guest-template')

@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
          <div>
            @if(session('success'))
                <div style="background-color: green; color: white; padding: 10px;">
                    {{ session('success') }}
                </div>
            @endif
            <h1>Job Operations Central Management System</h1>
            <h2>Lorem ipsum dolor sit amet, tota senserit percipitur ius ut, usu et fastidii forensibus voluptatibus. His ei nihil feugait</h2>
              <a href="{{ url('login/google') }}" class="download-btn"> 
                Sign in with CSPC Mail
              </a>
          </div>
        </div>
        <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
          <img src="{{ asset('landing/assets/img/hero-img.png') }}" class="img-fluid" alt="" style="width: auto; height: 500px;">
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero -->
  
  @endsection

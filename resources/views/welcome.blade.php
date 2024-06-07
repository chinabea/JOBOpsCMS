@extends('layouts.guest-template')

@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center mt-5">
        <!-- Success Message -->
        @if(session('success'))
          <div class="alert alert-success" role="alert" data-aos="fade-up">
            {{ session('success') }}
          </div>
        @endif
        <!-- End Success Message -->
        
        <h1 data-aos="fade-up">Job Operations Central Management System</h1>
        <h2 data-aos="fade-up" data-aos-delay="400">We are a team of talented designers making websites with Bootstrap</h2>
        <div data-aos="fade-up" data-aos-delay="600">
          <div class="text-center text-lg-start">
            <a href="{{ url('login/google') }}" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Sign In with CSPC Mail</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 hero-img mt-5" data-aos="zoom-out" data-aos-delay="200">
        <img src="{{ asset('landing/assets/img/features-2.png') }}" class="img-fluid" alt="">
      </div>
    </div>
  </div>

</section><!-- End Hero -->

@endsection

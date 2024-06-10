@extends('layouts.guest-template')
@section('content')
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 hero-img mt-5" data-aos="zoom-out" data-aos-delay="200">
        <img src="{{ asset('landing/assets/img/features-2.png') }}" class="img-fluid" alt="">
      </div>
      <div class="col-lg-6 d-flex flex-column justify-content-center mt-5">
        @if(session('success'))
          <div class="alert alert-success" role="alert" data-aos="fade-up">
            {{ session('success') }}
          </div>
        @endif
        <h1 data-aos="fade-up">Welcome to <br> Job Operations Central Management System</h1>
        <div data-aos="fade-up" data-aos-delay="600">
          <div class="text-center text-lg-start">
            <a href="{{ url('login/google') }}" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
              <div class="mx-auto">
                <img src="https://accounts.google.com/favicon.ico" alt="" width="25" class="mr-2">
                  <span>Login using CSPC Mail</span>
                  <i class="bi bi-arrow-right"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

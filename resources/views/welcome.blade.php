@extends('layouts.guest-template')
@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <!-- <h1 data-aos="fade-up">We offer modern solutions for growing your business</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">We are team of talented designers making websites with Bootstrap</h2> -->
          <h1 data-aos="fade-up">Job Operations Central Management System</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Enhancing operations for efficiency and control <br /> at every level</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">

                  <a href="{{ url('login/google') }}" title="Google Mail" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                      <div class="mx-auto">
                          <img src="https://accounts.google.com/favicon.ico" alt="" width="20" class="mr-2">
                          <span> Google Mail</span>
                          <i class="bi bi-arrow-right"></i>
                      </div>
                  </a>

              <!-- <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Started</span>
                <i class="bi bi-arrow-right"></i>
              </a> -->
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="landing/assets/img/features.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->
@endsection

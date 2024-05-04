
@extends('layouts.guest-template')

@section('content')

<section id="details" class="details">
    <div class="container">
        <div class="row content">
            <div class="col-md-4 mt-5" data-aos="fade-left">
                <img src="{{ asset('landing/assets/img/details-2.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-md-8 pt-4 mt-5" data-aos="fade-up">
                <h3>Account Pending Approval</h3>
                <p class="mb-4">Your account is currently pending approval by an administrator.<br>Please check back later.</p>
                <a href="{{ route('welcome') }}" class="btn btn-danger">Back</a>
            </div>
        </div>
    </div>
</section>

@endsection

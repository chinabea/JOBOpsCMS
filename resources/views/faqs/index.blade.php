@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mt-5 mb-4 text-center">Frequently Asked Questions</h1>
                            <div class="tab-content">
                                <div class="tab-pane active" id="timeline">
                                    @foreach($faqs as $faq)
                                    <div class="timeline timeline-inverse">
                                        <div class="time-label">
                                            <span class="bg-info">{{ $faq->created_at->format('j M. Y') }}</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-question bg-warning"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($faq->created_at)->format('h:i A') }}</span>
                                                <h3 class="timeline-header"><a href="#">{{ $faq->question }}</a></h3>
                                                <div class="timeline-body">
                                                    {!! $faq->answer !!}
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#showFaqModal" data-faq-id="{{ $faq->id }}">Read more</a>
                                                    @include('faqs.show')
                                                    
                                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editFaqModal{{ $faq->id }}">
                                                        Edit
                                                    </button>
                                                    @include('faqs.edit')
                                                    
                                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('destroy.faq', $faq->id) }}')"> Delete </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Floating button -->
<div class="float-button">
    <button  type="button"  class="btn btn-primary rounded-circle custom-btn btn-shadow" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#createFaqModal">
        <i class="fa fa-plus"></i>
    </button>
</div>
@include('faqs.create')

@endsection


@extends('layouts.template') @section('content') <div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title my-1"><i class="fa fa-book"></i> <b>Submitted Projects</b></h3> <br><br>
                            <h2>FAQs</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <a href="{{ route('create.faq') }}" class="btn btn-round btn-success">
                                    <i class="fa fa-plus-square"></i> Add FAQ </a>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-6 col-sm-6  ">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Frequently Ask Questions</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <ul class="list-unstyled timeline"> @foreach($faqs as $faq) <li>
                                                <div class="block">
                                                    <div class="tags">
                                                        <a href="" class="tag">
                                                            <span>Entertainment</span>
                                                        </a>
                                                    </div>
                                                    <div class="block_content">
                                                        <h2 class="title">
                                                            <a>{{ $faq->question }}</a>
                                                        </h2>
                                                        <div class="byline">
                                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                                        </div>
                                                        <p class="excerpt">{{ $faq->answer }}</a></p>
                                                        <a href="{{ route('update.faq', $faq->id) }}" type="button" class="btn btn-sm btn-warning">Edit </a>
                                                        <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('destroy.faq', $faq->id) }}')"> Delete </button>
                                                    </div>
                                                </div>
                                            </li> @endforeach </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </section>
                </div> 
                @endsection
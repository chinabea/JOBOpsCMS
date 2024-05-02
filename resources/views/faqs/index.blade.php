@extends('layouts.template')

@section('content')
<div class="right_col" role="main" style="min-height: 606.8px;">
    <div class="page-title">
        <div class="title_left">
            <h3>FAQs</h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2>FAQs</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('create.faq') }}" class="btn btn-round btn-success">
                        <i class="fa fa-plus-square"></i> Add FAQ
                    </a>
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
                  <ul class="list-unstyled timeline">
                    @foreach($faqs as $faq)
                    <li>
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
                          <a href="{{ route('update.faq', $faq->id) }}" type="button"
                                class="btn btn-sm btn-warning">Edit
                            </a>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('destroy.faq', $faq->id) }}')">
                                Delete
                            </button>
                        </div>
                      </div>
                    </li>
                    @endforeach
                  </ul>

                </div>
              </div>
            </div>
                <div class="col-md-6 col-sm-6 my-9">
                    <br><br><br>
                    <!-- <div class="x_panel"> -->
                        <img src="{{ asset('production/images/faq-img.png') }}"  style="width: 550px; height: auto;" alt="">
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.template')

@section('content')
<div class="right_col" role="main" style="min-height: 606.8px;">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>FAQ</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add F.A.Q.</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"> 
            <br><br>
            <form action="{{ route('store.faq') }}" method="post">
                @csrf
                <label for="question">Question</label> <br>
                <input  class="form-control" name="question" id="question" required></input><br>

                <label for="answer">Answer</label> <br>
                <input  class="form-control" name="answer" id="answer" required></input><br>

                <button type="submit" class="btn btn-primary col start" name="submit_project">
                    <i class="fa fa-upload"></i>
                    <span>Submit</span>
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

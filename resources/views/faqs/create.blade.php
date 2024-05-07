


@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title my-1"><i class="fa fa-book"></i> <b>Submitted Projects</b></h3> <br><br>
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
    </section>
</div>

@endsection


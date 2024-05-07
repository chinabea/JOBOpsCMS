
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
                            <form action="{{ route('edit.faq', $faq->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                
                                <label for="">Questions</label> <br>
                                <input class="form-control" name="question" id="question" value="{{ $faq->question }}" ></input><br>

                                <label for="">Answers</label> <br>
                                <input class="form-control" name="answer" id="answer" value="{{ $faq->answer }}" ></input><br>

                                <button type="submit" class="btn btn-primary col start" name="submit_project">
                                    <i class="fas fa-upload"></i>
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


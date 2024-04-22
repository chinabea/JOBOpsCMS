








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
                        <div class="card-header">
                            <h3 class="card-title my-1"> Edit FAQs</h3>
                        </div>
                        <div class="card-body">
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

@if(session('success'))
<script>
    toastr.success('{{ session('success') }}');
</script>
@elseif(session('delete'))
<script>
    toastr.delete('{{ session('delete') }}');
</script>
@elseif(session('message'))
<script>
    toastr.message('{{ session('message') }}');
</script>
@elseif(session('error'))
<script>
    toastr.error('{{ session('error') }}');
</script>
@endif

@endsection

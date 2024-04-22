


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
                            <div class="card-header border-0">
                                <h3 class="card-title"><b>Add FAQs</b></h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                <form action="{{ route('store.faq') }}" method="post">
                                    @csrf

                                    <label for="">Question</label> <br>
                                    <input  class="form-control" name="question" id="question" required></input><br>

                                    <label for="">Answer</label> <br>
                                    <input  class="form-control" name="answer" id="answer" required></input><br>

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
        </div>
    </section>
</div>


<script>
$(document).ready(function() {
    $('#example1').DataTable();
});
</script>

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

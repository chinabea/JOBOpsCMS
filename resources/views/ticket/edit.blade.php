
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
                        <form action="{{ route('edit.ticket', $ticket->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                            <label for="">Unit</label> <br>
                            <input class="form-control" name="unit" id="unit" value="{{ $ticket->unit }}" ></input><br>

                            <label for="">Request</label> <br>
                            <input class="form-control" name="request" id="request" value="{{ $ticket->request }}" ></input><br>

                            <label for="">Description</label> <br>
                            <input class="form-control" name="description" id="description" value="{{ $ticket->description }}"></input><br>

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



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
                            <h3 class="card-title my-1"><i class="fa fa-users"></i> Edit User</h3>
                            <button type="button" class="btn bg-navy color-palette float-right btn-sm" data-toggle="modal" data-target="#usersPdf" data-backdrop="static" data-keyboard="false"> 
                                <i class="fas fa-file-pdf"></i> Export to PDF</button>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.edit', $user->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <label for="inputText">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->first_name }} {{ $user->last_name }}" disabled>
                                    <br>
                                    <label for="inputText">Email</label>
                                    <input type="text" class="form-control"  id="email" name="email" value="{{ $user->email }}" disabled>
                                    <br>
                                    <label for="">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" value="{{ $user->role }}">
                                    <br>
                                <button type="submit" class="btn btn-warning">Update</button>
                                <br>
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

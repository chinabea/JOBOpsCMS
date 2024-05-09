

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
                            <div class="container">
                                <h1>Create Problem Type or Equipment</h1>
                                <form method="POST" action="{{ route('problemOrEquipments.store') }}">
                                    @csrf
                                    <div class="form-group">
    <label for="job_type_id">Job Type:</label>
    <select name="job_type_id" id="job_type_id" required>
        @foreach($jobTypes as $jobType)
            <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
        @endforeach
    </select>
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> 





@endsection

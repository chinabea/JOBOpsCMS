

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
                                <h1>Add Type of Request for ICTRAM</h1>
                             


                                <div class="container">
        <h2>Create MIS</h2>
        <form method="POST" action="{{ route('mises.store') }}">
            @csrf
            <div class="form-group">
                <label for="requesttype">Request Type</label>
                <input type="text" class="form-control" id="requesttype" name="requesttype" required>
            </div>
            <div class="form-group">
                <label for="jobtype">Job Type</label>
                <input type="text" class="form-control" id="jobtype" name="jobtype" required>
            </div>
            <div class="form-group">
                <label for="asname">Assigned Name</label>
                <input type="text" class="form-control" id="asname" name="asname" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
















                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> 
@endsection

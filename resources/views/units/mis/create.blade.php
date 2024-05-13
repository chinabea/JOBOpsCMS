

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
                        <div class="card-body mt-5">
                            <div class="container">
                                <h2>Create MIS</h2>
                                <form method="POST" action="{{ route('mises.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <input type="text" class="form-control" id="unit" name="unit" value="MIS-Management Information System" required disabled>
                                    </div>
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
    </section>
</div> 
@endsection

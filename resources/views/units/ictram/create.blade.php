@extends('layouts.template')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ICTRAMs</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('ictram.store') }}" method="POST">
                                @csrf
                                <div>
                                    <h3>Job Type</h3>
                                    <label for="jobType_name">Name:</label>
                                    <input type="text" id="jobType_name" name="jobType_name" required>
                                </div>

                                <div>
                                    <h3>Equipment</h3>
                                    <label for="equipment_name">Name:</label>
                                    <input type="text" id="equipment_name" name="equipment_name" required>
                                </div>

                                <div>
                                    <h3>Problem</h3>
                                    <label for="problem_description">Description:</label>
                                    <input type="text" id="problem_description" name="problem_description" required>
                                </div>

                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
</div> 

@endsection

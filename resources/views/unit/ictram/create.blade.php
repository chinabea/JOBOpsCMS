

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
                                <h2><i class="fa fa-book"></i> Create ICTRAM</h2>
                                    <form method="POST" action="{{ route('ictrams.store') }}">
                                        @csrf
                                    <div class="form-group">
                                        <label for="unit_id">Unit</label>
                                        <select class="form-control" id="unit_id" name="unit_id" required>
                                            <option value="">Select Unit</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}"{{ $unit->name === 'ICTRAM' ? ' selected' : '' }}{{ $unit->name === 'ICTRAM' ? ' disabled' : '' }}>
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jobtype">Job Type</label>
                                        <input type="text" class="form-control" id="jobtype" name="jobtype" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="equipment">Equipment</label>
                                        <input type="text" class="form-control" id="equipment" name="equipment" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="problem">Problem</label>
                                        <input type="text" class="form-control" id="problem" name="problem" required>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_warrantry" name="is_warrantry">
                                        <label class="form-check-label" for="is_warrantry">Is Warrantry</label>
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

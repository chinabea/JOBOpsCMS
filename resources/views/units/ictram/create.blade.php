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
                                    <label for="jobType_id">Select Job Type:</label>
                                    <select id="jobType_id" name="jobType_id" onchange="toggleJobTypeInput(this.value)">
                                        <option value="">-- Select Job Type --</option>
                                        @foreach($jobTypes as $jobType)
                                            <option value="{{ $jobType->id }}">{{ $jobType->jobType_name }}</option>
                                        @endforeach
                                        <option value="other">Other</option>
                                    </select>
                                    <div id="jobType_other" style="display:none;">
                                        <label for="jobType_name">Other Job Type:</label>
                                        <input type="text" id="jobType_name" name="jobType_name">
                                    </div>
                                </div>

                                <div>
                                    <h3>Equipment</h3>
                                    <label for="equipment_id">Select Equipment:</label>
                                    <select id="equipment_id" name="equipment_id" onchange="toggleEquipmentInput(this.value)">
                                        <option value="">-- Select Equipment --</option>
                                        @foreach($equipments as $equipment)
                                            <option value="{{ $equipment->id }}">{{ $equipment->equipment_name }}</option>
                                        @endforeach
                                        <option value="other">Other</option>
                                    </select>
                                    <div id="equipment_other" style="display:none;">
                                        <label for="equipment_name">Other Equipment:</label>
                                        <input type="text" id="equipment_name" name="equipment_name">
                                    </div>
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

<script>
function toggleJobTypeInput(value) {
    document.getElementById('jobType_other').style.display = value === 'other' ? 'block' : 'none';
}

function toggleEquipmentInput(value) {
    document.getElementById('equipment_other').style.display = value === 'other' ? 'block' : 'none';
}
</script>

@endsection

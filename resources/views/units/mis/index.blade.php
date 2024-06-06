@extends('layouts.template')

@section('content')


<div class="content-wrapper">
    <section class="content-header">
        
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">MISes Assignation</h1>
          </div>
        </div>
      </div>

    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card px-3 pt-3 pb-1">
                        <form id="jobForm" action="{{ route('mises.add-relation') }}" method="POST">
                                @csrf
                            <div class="d-md-flex flex-md-row flex-column justify-content-between gap-3">
                            <div class="mx-2 w-100">
                                <div class="d-flex align-items-center mb-1 mt-2">
                                    <label for="requestType">Request Type</label>
                                </div>
                                <div class="dropdown">
                                    <select name="mis_request_type_id" id="mis_request_type_id" class="selectpicker form-control" data-live-search="true" onchange="showfield(this.value, 'div1')" required>
                                    <option value="" disabled selected>Select Request Type</option>
                                        @foreach($requestTypes as $requestType)
                                            <option value="{{ $requestType->id }}">{{ $requestType->requestType_name }}</option>
                                        @endforeach
                                        <div class="fixed"><option value="requestType">Other Sources</option></div>
                                    </select>
                                    <div class="form-group">
                                        <div class="w-100" id="div1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 w-100">
                                <div class="d-flex align-items-center mb-1 mt-2">
                                    <label for="jobType">Job Type</label>
                                </div>
                                <div class="dropdown">
                                    <select name="mis_job_type_id" id="mis_job_type_id" class="selectpicker form-control" data-live-search="true" onchange="showfield(this.value, 'div2')" required>
                                    <option value="" disabled selected>Select Job Type</option>
                                        @foreach($jobTypes as $jobType)
                                            <option value="{{ $jobType->id }}">{{ $jobType->jobType_name }}</option>
                                        @endforeach
                                        <div class="fixed"><option value="jobType">Other Sources</option></div>
                                    </select>
                                    <div class="form-group">
                                        <div class="w-100" id="div2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 w-100">
                                <div class="d-flex flex-row justify-content-between align-items-center mb-1 mt-2">
                                    <label for="asName">Account Name</label>
                                </div>
                                <div class="dropdown">
                                    <select name="mis_asName_id" id="mis_asName_id" class="selectpicker form-control" data-live-search="true" onchange="showfield(this.value, 'div3')" required>
                                    <option value="" disabled selected>Select Account Name</option>
                                        @foreach($asNames as $asName)
                                            <option value="{{ $asName->id }}">{{ $asName->name }}</option>
                                        @endforeach
                                        <div class="fixed"><option value="asName">Other Sources</option></div>
                                    </select>
                                    <div class="form-group">
                                        <div class="w-100" id="div3"></div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="d-flex flex-row justify-content-end mx-2 mt-3">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-check"></i> Save
                            </button>
                            </div>
                        </form>
                    </div>
            <table iid="example1" class="table table-bordered table-hover text-center table-sm">
                <tbody>
                    @foreach ($sortedMises->groupBy('requestTypeName.requestType_name') as $requestTypeName => $mises)
                        <tr>
                            <th class="bg-info py-2" colspan="4">{{ $requestTypeName }}</th>
                        </tr>
                        <tr>
                            <th>Equipment</th>
                            <th>Problem</th>
                            <th width="7%">Action</th>
                        </tr>
                        @foreach ($mises as $index => $mis)
                            <tr>
                                <td>{{ $mis->jobType->jobType_name }}</td>
                                <td>{{ $mis->asName->name }}</td>
                                <td>
                                    @include('units.mis.modal.delete-dataWithRelation')
                                    <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#misDeletedataWithRelationModal{{ $mis->id }}" style="opacity: 0.8;"><i class="fas fa-trash text-red"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</section>  
</div> 
@endsection

<style>
    .scrollable-menu {
        max-height: 250px;
        overflow-y: auto;
    }
</style>
<script type="text/javascript">
function showfield(name, divId){
    var divElement = document.getElementById(divId);
    var selectElement = document.getElementById('mis_asName_id');
    var selectedValues = Array.from(selectElement.selectedOptions).map(option => option.value);

    if (name === 'requestType') {
        divElement.innerHTML = 'Other: <input class="form-control" type="text" name="requestType_other" placeholder="Please Specify Request Type" required/>';
    } else if (name === 'jobType') {
        divElement.innerHTML = 'Other: <input class="form-control" type="text" name="jobType_other" placeholder="Please Specify Job Type" required/>';
    } else if (selectedValues.includes('asName')) {
        selectElement.value = 'asName';
        divElement.innerHTML = 'Other: <input class="form-control" type="text" name="asName_other" placeholder="Please Specify Account Name" required/>';
        // divElement.removeAttribute("multiple");
        divElement.click();
    } else {
        divElement.innerHTML = '';
    }
}
</script>

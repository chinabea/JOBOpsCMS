@extends('layouts.template')

@section('content')


<div class="content-wrapper">
    <section class="content-header">
        
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ICTRAMs Assignation</h1>
          </div>
        </div>
      </div>

    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card px-3 pt-3 pb-1">
                        @include('units.ictram.modal.create-jobType')
                        @include('units.ictram.modal.create-equipment')
                        @include('units.ictram.modal.create-problem')
                        <form id="jobForm" action="{{ route('ictrams.add-relation') }}" method="POST" onsubmit="return validateForm()">
                                @csrf
                            <div class="d-md-flex flex-md-row flex-column justify-content-between gap-3">
                            <div class="mx-2 w-100">
                                <div class="d-flex flex-row justify-content-between align-items-center mb-1 mt-2">
                                    <label for="jobType">Job Type</label>
                                    <div>
                                    <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ictramCreateJobTypeModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <select name="ictram_job_type_id" id="ictram_job_type_id" class="selectpicker form-control" data-live-search="true" required>
                                    <option value="" disabled selected>Select Job Type</option>
                                        @foreach($jobTypes as $jobType)
                                            <option value="{{ $jobType->id }}">{{ $jobType->jobType_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mx-2 w-100">
                                <div class="d-flex flex-row justify-content-between align-items-center mb-1 mt-2">
                                    <label for="equipment">Equipment</label>
                                    <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ictramCreateEquipmentModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="dropdown">
                                    <select name="ictram_equipment_id" id="ictram_equipment_id" class="selectpicker form-control" data-live-search="true" required>
                                        <option value="" disabled selected>Select Equipment</option>
                                        @foreach($equipments as $equipment)
                                            <option value="{{ $equipment->id }}">{{ $equipment->equipment_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mx-2 w-100">
                                <div class="d-flex flex-row justify-content-between align-items-center mb-1 mt-2">
                                    <label for="jobType">Problem</label>
                                    <div>
                                    <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ictramCreateProblemModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <select name="ictram_problem_ids[]" id="ictram_problem_id" class="selectpicker form-control" data-live-search="true" multiple required>
                                        @foreach ($problems as $problem)
                                        <option value="{{ $problem->id }}">{{ $problem->problem_description }}</option>
                                        @endforeach
                                    </select>
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
            <table id="datatable-responsive" class="table table-bordered table-hover text-center table-sm">
                <tbody>
                    @foreach ($sortedIctrams->groupBy('jobType.jobType_name') as $jobTypeName => $ictrams)
                        <tr>
                            <th class="bg-info py-2" colspan="4">{{ $jobTypeName }}</th>
                        </tr>
                        <tr>
                            <th>Equipment</th>
                            <th>Problem</th>
                            <th width="7%">Action</th>
                        </tr>
                        @foreach ($ictrams as $index => $ictram)
                            <tr>
                                <td>{{ $ictram->equipment->equipment_name }}</td>
                                <td>{{ $ictram->problem->problem_description }}</td>
                                <td>
                                    @include('units.ictram.modal.delete-dataWithRelation')
                                    <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#ictramDeletedataWithRelationModal{{ $ictram->id }}" style="opacity: 0.8;"><i class="fas fa-trash text-red"></i></button>
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

<script>
function toggleDropdown(menuId) {
    var dropdownMenus = document.querySelectorAll('.dropdown-menu');
    dropdownMenus.forEach(function(menu) {
        if(menu.id !== menuId){
        menu.classList.remove("show");
        }
    });
    var dropdownMenu = document.getElementById(menuId);
    dropdownMenu.classList.toggle("show");
}
function selectItemJobType(item1, item, displayId, hiddenId, menuId) {
    document.getElementById(displayId).value = item;
    document.getElementById(hiddenId).value = item1;
    toggleDropdown(displayId.replace("displayFieldJobType", "dropdownMenuJobType"));
}
function selectItemEquipment(item1, item, displayId, hiddenId, menuId) {
    console.log("selectItemEquipment", item1);
    document.getElementById(displayId).value = item;
    document.getElementById(hiddenId).value = item1;
    toggleDropdown(displayId.replace("displayFieldEquipment", "dropdownMenuEquipment"));
}
function selectItemProblem(item1, item, displayId, hiddenId, menuId) {
    document.getElementById(displayId).value = item;
    document.getElementById(hiddenId).value = item1;

    toggleDropdown(displayId.replace("displayFieldProblem", "dropdownMenuProblem"));
}

function filterDropdown(menuId) {
    var input, filter, dropdownItems, items, i;
    input = document.querySelector("#" + menuId + " .search-input");
    filter = input.value.toUpperCase();
    dropdownItems = document.querySelectorAll("#" + menuId + " .dropdown-item");
    for (i = 0; i < dropdownItems.length; i++) {
        items = dropdownItems[i].innerText;
        if (items.toUpperCase().indexOf(filter) > -1) {
            dropdownItems[i].style.display = "";
        } else {
            dropdownItems[i].style.display = "none";
        }
    }
}
function validateForm() {
    var jobTypeField = document.getElementById("displayFieldJobType").value.trim();
    var EquipmentField = document.getElementById("displayFieldEquipment").value.trim();
    var ProblemField = document.getElementById("displayFieldProblem").value.trim();
    if (jobTypeField === "") {
        document.getElementById("jobTypeValidationMessage").style.display = "block";
        return false;
    } else if (EquipmentField === ""){
        document.getElementById("EquipmentValidationMessage").style.display = "block";
        document.getElementById("jobTypeValidationMessage").style.display = "none";
        return false;
    } else if (ProblemField === ""){
        document.getElementById("ProblemValidationMessage").style.display = "block";
        document.getElementById("EquipmentValidationMessage").style.display = "none";
        return false;
    }
    // Add validation for other fields similarly
    
    return true;
}
</script>
<div class="modal fade" id="ictramCreateJobTypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Job Types</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="jobForm" action="{{ route('ictrams.storeJobType') }}" method="POST">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="mb-3">
                        <div class="d-flex flex-row justify-content-between align-content-center mb-1 mt-2">
                            <label for="jobType">Job Type</label>
                            <div>
                            <button type="button" class="btn bg-info float-right mx-1" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ictramCreateJobTypeModal222">
                                <i class="fas fa-plus"></i> Add Equipment
                            </button>
                            </div>
                        </div>
                        <div class="dropdown">
                            <input class="form-control" type="text" id="displayFieldJobType" name="jobType_name" placeholder="Select JobType" onclick="toggleDropdown('dropdownMenuJobType')" readonly>
                            <input type="hidden" id="hiddenInputJobType" name="ictram_job_type_id">
                            <div class="dropdown-menu scrollable-menu" id="dropdownMenuJobType" aria-labelledby="dropdownMenuButtonJobType">
                                <div class="px-2 w-100 sticky-top">
                                    <input type="text" class="form-control search-input px-3" placeholder="Search..." oninput="filterDropdown('dropdownMenuJobType')">
                                </div>
                                    @foreach($jobTypes as $jobType)
                                        <a class="dropdown-item" href="#" onclick="selectItemJobType('{{ $jobType->id }}', '{{ $jobType->jobType_name }}', 'displayFieldJobType', 'hiddenInputJobType')">{{ $jobType->jobType_name }}</a>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex flex-row justify-content-between align-content-center mb-1 mt-2">
                            <label for="equipment">Equipment</label>
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Add Equipment</button>
                        </div>
                        <div class="dropdown">
                            <input class="form-control" type="text" id="displayFieldEquipment" name="equipment_name" placeholder="Select Equipment" onclick="toggleDropdown('dropdownMenuEquipment')" readonly>
                            <input type="hidden" id="hiddenInputEquipmentId" name="ictram_equipment_id">
                            <div class="dropdown-menu scrollable-menu" id="dropdownMenuEquipment" aria-labelledby="dropdownMenuButtonEquipment">
                                <div class="px-2 w-100 sticky-top">
                                    <input type="text" class="form-control search-input px-3" placeholder="Search..." oninput="filterDropdown('dropdownMenuEquipment')">
                                </div>
                                @foreach($equipments as $equipment)
                                    <a class="dropdown-item" href="#" onclick="selectItemEquipment('{{ $equipment->id }}', '{{ $equipment->equipment_name }}', 'displayFieldEquipment', 'hiddenInputEquipmentId')">{{ $equipment->equipment_name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    
                    <div class="mb-3">
                        <div class="d-flex flex-row justify-content-between align-content-center mb-1 mt-2">
                            <label for="problem">Problem</label>
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Add Problem</button>
                        </div>
                        <div class="dropdown">
                            <input class="form-control" type="text" id="displayFieldProblem" name="problem_description" placeholder="Select Problem" onclick="toggleDropdown('dropdownMenuProblem')" readonly>
                            <input type="hidden" id="hiddenInputProblem">
                            <div class="dropdown-menu scrollable-menu" id="dropdownMenuProblem" aria-labelledby="dropdownMenuButtonProblem">
                                <div class="px-2 w-100 sticky-top">
                                    <input type="text" class="form-control search-input px-3" placeholder="Search..." oninput="filterDropdown('dropdownMenuProblem')">
                                </div>
                                    @foreach($problems as $problem)
                                        <a class="dropdown-item" href="#" onclick="selectItemProblem('{{ $problem->id }}', '{{ $problem->problem_description }}', 'displayFieldProblem', 'hiddenInputProblem')">{{ $problem->problem_description }}</a>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                     
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add equipment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .scrollable-menu {
        max-height: 200px;
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
</script>

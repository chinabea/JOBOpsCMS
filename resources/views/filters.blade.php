
<script>
    function removeEmptyFields(event) {
        const form = event.target;
        const elements = form.elements;
        for (let i = elements.length - 1; i >= 0; i--) {
            const element = elements[i];
            if (element.name && !element.value) {
                element.name = ''; // Remove the name to exclude it from the submission
            }
        }
    }
</script>

<aside class="control-sidebar bg-light shadow border">
    <div class="p-3">
        <button class="close" aria-label="Close" onclick="document.querySelector('.control-sidebar').style.display='none';">
            <span aria-hidden="true">&times;</span>
        </button>

        <h5>Filter</h5><hr>
        <form id="filterForm" method="GET" action="{{ route('tickets.report') }}">
            
            <div id="filterSidebar">
                <div class="form-group">
                    <label for="search">Search</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                </div>

                <div class="form-group">
                    <label for="building_number">Building Number</label>
                    <select class="form-control" name="building_number" id="building_number">
                        <option value="">Select Building Number</option>
                        @foreach($tickets->unique('building_number') as $ticket)
                            <option value="{{ $ticket->building_number }}">{{ $ticket->building_number }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="priority_level">Priority Level</label>
                    <select class="form-control" name="priority_level" id="priority_level">
                        <option value="">Select Priority Level</option>
                        @foreach($tickets as $ticket)
                            <option value="{{ $ticket->priority_level }}">{{ $ticket->priority_level }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="">Select Status</option>
                        <option value="Open" {{ request('status') == 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sort_by">Sort By</label>
                    <select class="form-control" name="sort_by" id="sort_by">
                        <option value="">Select Sort By</option>
                        <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID</option>
                        <option value="building_number" {{ request('sort_by') == 'building_number' ? 'selected' : '' }}>Building Number</option>
                        <option value="office_name" {{ request('sort_by') == 'office_name' ? 'selected' : '' }}>Office Name</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <select class="form-control" name="sort_order" id="sort_order">
                        <option value="">Select Sort Order</option>
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <a href="{{ route('tickets', array_merge(request()->query(), ['export' => 'pdf'])) }}" class="btn btn-sm btn-danger text-white">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a>
                <a href="{{ route('tickets', array_merge(request()->query(), ['export' => 'excel'])) }}" class="btn btn-sm btn-success text-white">
                    <i class="fa fa-file-excel"></i> Export Excel
                </a>
            </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Search</button>
        </div>
               
        </form>
    </div>
</aside>

<script>
    $(document).ready(function() {
        // Function to remove empty fields before sending the form data
        function removeEmptyFields(formData) {
            return formData.filter(function(field) {
                return field.value.trim() !== "";
            });
        }

        // Function to submit the form via AJAX
        function submitFilterForm() {
            const $form = $('#filterForm');
            const formData = $form.serializeArray();
            const filteredData = removeEmptyFields(formData);

            $.ajax({
                url: $form.attr('action'),
                method: 'GET',
                data: $.param(filteredData),
                success: function(response) {
                    // Assuming the response contains the HTML to update the ticket list
                    $('#ticketList').html(response);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
        }

        // Event listener for form change
        $('#filterForm').on('change', 'input, select', function() {
            submitFilterForm();
        });

        // Close sidebar button
        $('.close').click(function() {
            $('.control-sidebar').hide();
        });
    });
</script>

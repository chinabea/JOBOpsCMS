<!-- Delete Job Type Modal -->
<div class="modal fade" id="misDeleteEquipmentModal{{ $requestType->id }}" tabindex="-1" role="dialog" aria-labelledby="misDeleteEquipmentModal{{ $requestType->id }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ictramDeleteEquipmentModal{{ $requestType->id }}Label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="font-weight-bold">Are you sure you want to delete "{{ $requestType->requestType_name }}"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('mises.destroyRequestType', $requestType->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="assignUserModal{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="assignUserModalLabel{{ $ticket->id }}" aria-hidden="true">
                                                
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignUserModalLabel{{ $ticket->id }}">Assign User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tickets.updateUsers', $ticket->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select class="form-control" id="assigned_user_id{{ $ticket->id }}" name="assigned_user_id[]" data-live-search="true" required>
                            @foreach($userIds as $user)
                                @if($ticket->ictram && in_array($user->role, [2, 7]))
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    <!-- <option value="{{ $user->id }}" data-content="
                                        <span class='text-black'><strong>{{ $user->name }}</strong><br>
                                        <small>Expertise: {{ implode(', ', $user->expertise ?? []) }}</small><br>
                                        <small>Assigned to Tickets: {{ $user->tickets->count() }}</small></span>">
                                    </option> -->
                                @elseif($ticket->nicmu && in_array($user->role, [3, 8]))
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    <!-- <option value="{{ $user->id }}" data-content="
                                        <span class='text-black'><strong>{{ $user->name }}</strong><br>
                                        <small>Expertise: {{ implode(', ', $user->expertise ?? []) }}</small><br>
                                        <small>Assigned to Tickets: {{ $user->tickets->count() }}</small></span>">
                                    </option> -->
                                @elseif($ticket->mis && in_array($user->role, [4, 9]))
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    <!-- <option value="{{ $user->id }}" data-content="
                                        <span class='text-black'><strong>{{ $user->name }}</strong><br>
                                        <small>Expertise: {{ implode(', ', $user->expertise ?? []) }}</small><br>
                                        <small>Assigned to Tickets: {{ $user->tickets->count() }}</small></span>">
                                    </option> -->
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
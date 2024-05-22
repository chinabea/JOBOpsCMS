
@foreach ($tickets as $ticket)
<tr>
    <td>{{ $ticket->id }}</td>
    <td>{{ $ticket->title }}</td>
    <td>{{ $ticket->building_number }}</td>
    <td>{{ $ticket->priority_level }}</td>
    <td>{{ $ticket->status }}</td>
</tr>
@endforeach

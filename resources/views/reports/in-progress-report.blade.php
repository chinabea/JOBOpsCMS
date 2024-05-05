<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
    <link rel="stylesheet" type="text/css" href="report.css" />
</head>
<body>
    <header>
        <img class="cspc-logo" src="{{ public_path('production/images/CSPC-Logo.jpg') }}" alt="CSPC Logo">
        <img class="mict-logo" src="{{ public_path('production/images/MICT-Logo.png') }}" alt="MICT Logo">
        <div class="institution-details">
            <p class="republic">Republic of the Philippines</p>
            <p class="cspc">Camarines Sur Polytechnic Colleges</p>
            <p class="republic">Nabua, Camarines Sur</p>
        </div>
            <p class="mict">Management Information and Communication Technology</p>
        <img class="header-line" src="{{ public_path('production/images/header-line.png') }}" alt="Header Line">
    </header>
    <h2 class="text-center">STATUS: IN PROGRESS TICKETS</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Unit</th>
                    <th>Request</th>
                    <th>Assigned to</th>
                    <th>Priority</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                @if(auth()->user()->role == 1 || (auth()->user()->role == 2 && $ticket->assigned_to == auth()->id()))
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ $ticket->service_location }}</td>
                    <td>{{ $ticket->unit }}</td>
                    <td>{{ $ticket->request }}</td>
                    <td>{{ $ticket->assignedUser->name }}</td>
                    <td>{{ $ticket->priority_level }}</td>
                    <td>{{ $ticket->status }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </body>
</html>

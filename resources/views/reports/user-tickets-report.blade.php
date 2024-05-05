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
    <h2 class="text-center">TICKETS</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Unit</th>
                    <th>Request</th>
                    <th>Description</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ticket->unit }}</td>
                            <td>{{ $ticket->request }}</td>
                            <td>{{ $ticket->description }}</td>
                            <td>{{ $ticket->status }}</td>
                            <td>{{ $ticket->created_at->toFormattedDateString() }}</td>
                        </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Unit</th>
                    <th>Request</th>
                    <th>Description</th>
                    <th>Created At</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>

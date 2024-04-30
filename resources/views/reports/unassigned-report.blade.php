<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
    <link rel="stylesheet" type="text/css" href="report.css" />
</head>
<body>

    <img id="pdfLogo1" src="{{ public_path('dist/img/cspcLogo1.jpg') }}" alt="logo" style="max-width: 9.5%; margin: 0;">
    <img id="pdfLogo2" src="{{ public_path('dist/img/AIRCoDeLogo1.jpg') }}" alt="logo" style="max-width: 35%; margin: 0;">
    <div class="custom-paragraph">
        <p style="font-size: 10pt; font-family: 'Calibri', sans-serif;">Republic of the Philippines</p>
        <p style="font-size: 12pt; font-weight: bold; font-family: 'Calibri', sans-serif;">Camarines Sur Polytechnic Colleges</p>
        <p style="font-size: 10pt; font-family: 'Calibri', sans-serif;">Nabua, Camarines Sur</p>
    </div>
    <p style="font-size: 13pt; font-weight: bold; font-family: 'Calibri', sans-serif; margin-bottom: 1;">MICT</p>
    <img id="pdfLogo" src="{{ public_path('dist/img/headerLine.jpg') }}" alt="logo"style="width: 100%; margin: 0;">


            <header class="text-center">UNASSIGNED TICKETS</header><br>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Request by</th>
                        <th>Location</th>
                        <th>Unit</th>
                        <th>Request</th>
                        <th>Priority</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unassignedTickets as $ticket)
                    @if(auth()->user()->role == 1 || (auth()->user()->role == 2 && $ticket->assigned_to == auth()->id()))
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ticket->user->name }}</td>
                        <td>{{ $ticket->service_location }}</td>
                        <td>{{ $ticket->unit }}</td>
                        <td>{{ $ticket->request }}</td>
                        <td>{{ $ticket->priority_level }}</td>
                        <td>{{ $ticket->status }}</td>
                    </tr>
                      @endif
                      @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>

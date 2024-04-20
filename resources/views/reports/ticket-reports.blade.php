<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
    <link rel="stylesheet" type="text/css" href="css\report.css" />
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


    <div class="text-center">
        <br><header>TICKETS</header>
    </div>
    
    <table id="example1" class="table table-bordered table-hover text-center">
        <thead>
            <tr>
                <th class="align-middle">#</th>
                <th class="align-middle">Unit</th>
                <th class="align-middle">Request</th>
                <th class="align-middle">Description</th>
                <th class="align-middle">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $ticket->unit }}</td>
                        <td class="align-middle">{{ $ticket->request }}</td>
                        <td class="align-middle">{{ $ticket->description }}</td>
                        <td class="align-middle">{{ $ticket->created_at->format('F j, Y') }}</td>
                    </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="align-middle">#</th>
                <th class="align-middle">Unit</th>
                <th class="align-middle">Request</th>
                <th class="align-middle">Description</th>
                <th class="align-middle">Created At</th>
            </tr>
        </tfoot>
    </table>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
    <link rel="stylesheet" type="text/css" href="report.css" />
    <title>Tickets Export</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <header>
        <img class="cspc-logo" src="{{ public_path('dist/img/CSPC-Logo.jpg') }}" alt="CSPC Logo">
        <img class="mict-logo" src="{{ public_path('dist/img/MICT-Logo.png') }}" alt="MICT Logo"> 
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
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Building Number</th>
                    <th>Office Name</th>
                    <th>Priority Level</th>
                    <th>Description</th>
                    <th>File Path</th>
                    <th>Status</th>
                    <th>Serial Number</th>
                    <th>Covered Under Warranty</th>
                    <th>ICTRAM Job Type ID</th>
                    <th>ICTRAM Equipment ID</th>
                    <th>ICTRAM Problem ID</th>
                    <th>NICMU Job Type ID</th>
                    <th>NICMU Equipment ID</th>
                    <th>NICMU Problem ID</th>
                    <th>MIS Request Type ID</th>
                    <th>MIS Job Type ID</th>
                    <th>MIS ASName ID</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ $ticket->building_number }}</td>
                    <td>{{ $ticket->office_name }}</td>
                    <td>{{ $ticket->priority_level }}</td>
                    <td>{{ $ticket->description }}</td>
                    <td>{{ $ticket->file_path }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->serial_number }}</td>
                    <td>
                        {{ $ticket->covered_under_warranty ? 'Yes' : 'No' }}
                    </td>
                    <td>{{ $ticket->ictram_job_type_id }}</td>
                    <td>{{ $ticket->ictram_equipment_id }}</td>
                    <td>{{ $ticket->ictram_problem_id }}</td>
                    <td>{{ $ticket->nicmu_job_type_id }}</td>
                    <td>{{ $ticket->nicmu_equipment_id }}</td>
                    <td>{{ $ticket->nicmu_problem_id }}</td>
                    <td>{{ $ticket->mis_request_type_id }}</td>
                    <td>{{ $ticket->mis_job_type_id }}</td>
                    <td>{{ $ticket->mis_asname_id }}</td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>{{ $ticket->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>

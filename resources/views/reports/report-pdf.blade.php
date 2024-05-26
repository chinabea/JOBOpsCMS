<!-- <!DOCTYPE html>
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
                    <th>ICTRAM</th>
                    <th>NICMU</th>
                    <th>MIS</th>
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
                    <td>{{ $ticket->covered_under_warranty ? 'Yes' : 'No' }}</td>
                    <td>{{ $ticket->ictram_id }}</td>
                    <td>{{ $ticket->nicmu_id }}</td>
                    <td>{{ $ticket->mis_id }}</td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>{{ $ticket->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets Export</title>
    <style>
        /* Inline styles */
      
.text-center {
    text-align: center;
}

body {
    font-family: "Times New Roman", serif;
    font-size: 11pt;
    color: black;
    /* margin-left: 0.5in;
    margin-right: 0.5in; */
    margin-bottom: 0.5in;
    margin-top: 0.1in;
    /* margin-left: 2em; Adjust the value as needed */
}

h1,
h2 {
    font-size: 12pt;
}

h3,
p {
    font-size: 11pt;
    text-align: justify;
}

.tab {
    margin-top: 0;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 5px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

.align-middle {
    vertical-align: middle;
}

.institution-details {
    line-height: 0.2;
    font-family: 'Calibri', sans-serif;
}
.cspc-logo {
    max-width: 10%; 
    margin: 0;
}

.mict-logo {
    max-width: 11%; 
    margin: 0;
}
.republic {
    font-size: 10pt; 
}
.cspc {
    font-size: 12pt; 
    font-weight: bold; 
}
.mict {
    font-size: 13pt; 
    font-weight: bold; 
    margin-bottom: 1;
    font-family: 'Calibri', sans-serif;
}
.header-line {
    width: 100%; 
    margin: 0;
}

    </style>
</head>
<body>
    <header>
        <!-- Base64-encoded images -->
        <img class="cspc-logo" src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('dist/img/CSPC-Logo.jpg'))) }}" alt="CSPC Logo">
        <img class="mict-logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('dist/img/MICT-Logo.png'))) }}" alt="MICT Logo"> 
        <div class="institution-details">
            <p class="republic">Republic of the Philippines</p>
            <p class="cspc">Camarines Sur Polytechnic Colleges</p>
            <p class="republic">Nabua, Camarines Sur</p>
        </div>
        <p class="mict">Management Information and Communication Technology</p>
        <!-- Base64-encoded image -->
        <img class="header-line" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('dist/img/header-line.png'))) }}" alt="Header Line">
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
                <th>Status</th>
                <th>Serial Number</th>
                <th>Covered Under Warranty</th>
                
            @if($tickets->where('ictram_id', '!=', null)->count() > 0)
                <th>ICTRAM Job Type</th>
                <th>ICTRAM Equipment</th>
                <th>ICTRAM Problem/Issues</th>
            @endif

            @if($tickets->where('nicmu_id', '!=', null)->count() > 0)
                <th>NICMU Job Type</th>
                <th>NICMU Equipment</th>
                <th>NICMU Problem/Issues</th>
            @endif

            @if($tickets->where('mis_id', '!=', null)->count() > 0)
                <th>MIS Request Type</th>
                <th>MIS Job Type</th>
                <th>MIS Assigned Name</th>
            @endif
            
                <!-- <th>ICTRAM</th>
                <th>NICMU</th>
                <th>MIS</th> -->
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
                <td>{{ $ticket->status }}</td>
                <td>{{ $ticket->serial_number }}</td>
                <td>{{ $ticket->covered_under_warranty ? 'Yes' : 'No' }}</td>
                    @if($ticket->ictram)
                        <td>{{ $ticket->ictram->jobType->jobType_name }} </td>
                        <td>{{ $ticket->ictram->equipment->equipment_name }}</td>
                        <td>{{ $ticket->ictram->problem->problem_description }}</td>
                    @endif
                <td>
                    @if($ticket->nicmu)
                        <td>{{ $ticket->nicmu->job_type->name }}</td>
                        <td>{{ $ticket->nicmu->equipment->equipment_name }}</td>
                        <td>{{ $ticket->nicmu->problem->problem_description }}</td>
                    @endif
                </td>
                <td>
                    @if($ticket->mis)
                        {{ $ticket->mis->request_type->name }} - {{ $ticket->mis->job_type->name }} - {{ $ticket->mis->asname->name }}
                    @endif
                </td>
                <td>{{ $ticket->created_at ? $ticket->created_at->format('F j, Y g:i A') : 'N/A' }}</td>
                <td>{{ $ticket->updated_at ? $ticket->updated_at->format('F j, Y g:i A') : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

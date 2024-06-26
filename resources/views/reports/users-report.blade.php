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
    <h2 class="text-center">USERS</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>high-priority.report
                    <th>Role</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if ($user->role == 1)
                                    Admin
                                @elseif ($user->role == 2)
                                    MICT Staff
                                @elseif ($user->role == 3)
                                    Staff
                                @else
                                    Guest
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </body>
</html>

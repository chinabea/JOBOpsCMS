<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Ticket</title>
</head>
<body>
    <div style="padding: 10px;">
        <h4>Hello, {{ $user->name }}</h4>
        <p>You are assigned to a requested ticket, {{ $ticket->request }} from {{ $requestor->name }}</p>
        <p>Please click the button below to view the ticket.</p>
        
        <a href="{{ url('/show/ticket/' . $ticket->id) }}" class="button">View Ticket</a>
        <br><br>
        <p>Best Regards,</p>
        <p>MICT Support Team</p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requested Ticket</title>
</head>
<body>
    <div style="padding: 10px;">
        <h4>Hello, {{ $user->name }}</h4>
        <p>You have successfully requested a ticket, {{ $ticket->request }} </p>
            <!-- this should display the name of the assigned users -->
            <!-- assigned to {{ $assignedNames }} </p> -->
        <p>Please click the button below to view your ticket.</p>
            
        
        <a href="{{ url('/show/ticket/' . $ticket->id) }}" class="button">View Ticket</a>
       <br><br>
        <p>Best Regards,</p>
        <p>MICT Support Team</p>
        
    </div>
</body>
</html>

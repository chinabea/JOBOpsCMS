<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Ticket</title>
</head>
<body>
    <div style="padding: 10px;">
        <h2>Hello, {{ $user->first_name }}!</h2>
        <p>You are assigned to a requested ticket,</p> <b>Request Title</b> <p>from: Fullname
        <p>Please click the button below to view the ticket.</p>
            
        <a href="{{ $actionUrl }}" style="padding: 10px 20px; color: white; background-color: #007BFF; text-decoration: none;">View Ticket</a>
       
        <p>Best Regards,</p>
        <p>MICT Support Team</p>
    </div>
</body>
</html>

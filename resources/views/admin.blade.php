<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MICT JOBOps | Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/MICT-Logo.png') }}">
</head>
<body>
    <h1>Admin Successfully login!!</h1>
          @if(auth()->check())
          <a href="{{ route('notifications') }}">Notifications ({{ auth()->user()->unreadNotifications->count() }})</a><br>
          @endif
    
    <a href="users">users</a> <br>
    <a href="tickets">Tickets</a> <br>
    <a href="{{ route('create.ticket') }}">Create ticket</a> <br>
    <a href="{{ route('faqs') }}">FAQs</a> <br>
    <a href="{{ route('create.faq') }}">Create FAQs</a> <br>


</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Template</title>
</head>

<body>
    <h1>Hello {{ $user->name }}</h1>
    @if ($user->role == 1)
        <p>User replied to a ticket</p>
    @else
        <p>You got one message</p>
    @endif
</body>

</html>

<html>

<head>
    <title>verification mail</title>
</head>

<body>

    <h1>Hello! {{ $user->name }}</h1>

    <p>welcome !!</p>






    <h1>Please click the link to verify the user <a
            href="{{ route('employee.verify', ['id' => $user->verification]) }}">link</a></h1>


    <strong>Thank you Sir. :)</strong>

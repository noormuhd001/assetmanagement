<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Email Confirmation</title>
</head>

<body>



    <h1>Hello! {{ $user->name }}</h1>
    <br>

    <p>Verification successful!</p>




    <!-- Include SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // Trigger SweetAlert success notification
        Swal.fire({
            icon: 'success',
            title: 'Verification Successful',
            text: 'User verified successfully'
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>
</head>

<body>
    <h1>Verification Failed</h1>
    <p>Failed to verify the user.</p>

    <!-- Include SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Trigger SweetAlert error notification
        Swal.fire({
            icon: 'error',
            title: 'Verification Failed',
            text: 'Failed to verify the user'
        });
    </script>
</body>

</html>

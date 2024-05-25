<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Validation Form</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <style>
        .center-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="center-wrapper">
        <div class="form-container">
            <div class="col-md-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> Login to system</h3>
                    </div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror " id="email"
                                    placeholder="Enter email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror " id="password"
                                    placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <p>Create an account <a href="{{ route('register') }}">signup</a></p>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
            </div>
            </section>
        </div>
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>

<?php
$verifycode = random_int(1, PHP_INT_MAX);
$successMessage = session('success');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Validation Form</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    <div class="wrapper">
        <div class="center-wrapper">
            <div class="form-container">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> Signup</h3>
                        </div>
                        <form action="{{ route('signup') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="verification" id="verification"
                                        value="{{ $verifycode }}">
                                    <label for="username">name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror " id="name"
                                        placeholder="Enter username" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" placeholder="Enter Phone No"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}">
                                </div>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input"
                                            id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1">I agree to the <a
                                                href="#">terms of service</a>.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="submit" class="btn btn-primary">
                                <p>Already have an Account <a href="{{ route('loginpage') }}">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
        </section>
    </div>
    @if ($successMessage)
        <script>
            $(document).ready(function() {
                $(document).Toasts('create', {
                    title: 'Success',
                    subtitle: 'Email Sent',
                    body: '{{ $successMessage }}',
                    autohide: false,
                    class: 'bg-success',
                    delay: 10000
                });
            });
        </script>
    @endif


    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>

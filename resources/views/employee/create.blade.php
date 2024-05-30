@extends('layout.layout')

@section('content')
    @push('script')
        <style>
            .invalid-feedback {
                color: red;
            }
        </style>
    @endpush
    @php

        $verifycode = random_int(1, PHP_INT_MAX);
        $successMessage = session('success');

    @endphp
    <div class="content-wrapper">
    @section('breadcrumbs')
        {{ Breadcrumbs::render('employee.create') }}
    @endsection
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Employee</div>
                    <div class="card-body">
                        <form method="POST" id="addemployee">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="hidden" name="verification" id="verification" value="{{ $verifycode }}">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input id="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    Submit
                                </button>
                                <a href="{{ route('employeedetails') }}"> <button type="button" class="btn btn-danger" id="cancelBtn">
                                    Cancel
                                </button></a>
                                <p class="text text-danger" id="message"></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
   <script>
        const LOGIN_ROUTE = "{{ route('employee.store') }}";
        const COMMITTEE_ROUTE = "{{ route('employee.create') }}";
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="{{ asset('../../plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('../../dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/dist/js/ajax/addemployee.js') }}"></script>

@endpush
@endsection

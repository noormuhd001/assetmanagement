@extends('layout.layout')
@section('content')
@section('breadcrumbs')
    {{ Breadcrumbs::render('employee.edit', $user->id) }}
@endsection
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit </div>
                <div class="card-body">
                    <form method="POST" id="editemployee">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $user->name }}">
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
                                value="{{ $user->email }}">

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
                                value="{{ $user->phone }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input id="password" type="hidden" class="form-control" name="password"
                            value="{{ $user->password }}">
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                Submit
                            </button>
                            <a href="{{ route('employeedetails') }}"> <button type="button" class="btn btn-danger" id="cancelBtn">
                                Cancel
                            </button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection


@push('script')
<script>
    const LOGIN_ROUTE = "{{ route('employee.update') }}";
    const COMMITTEE_ROUTE = "{{ route('employeedetails') }}";
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="{{ asset('../../plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('../../dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/dist/js/ajax/editemployee.js') }}"></script>
@endpush

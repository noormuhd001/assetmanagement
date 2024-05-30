@extends('layout.layout')

@section('content')
@section('breadcrumbs')
    {{ Breadcrumbs::render('asset.edit', $asset->id) }}
@endsection

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit</div>
                <div class="card-body">
                    <form method="POST" id="editasset">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="{{ $asset->id }}">
                            <label for="name">Name</label>
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $asset->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input id="category" type="text"
                                class="form-control @error('category') is-invalid @enderror" name="category"
                                value="{{ $asset->category }}">

                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input id="model" type="text"
                                class="form-control @error('model') is-invalid @enderror" name="model"
                                value="{{ $asset->model }}">

                            @error('model')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                Submit
                            </button>
                            <a href="{{ route('asset.index') }}"> <button type="button" class="btn btn-danger" id="cancelBtn">
                                Cancel
                            </button></a>
                        </div>
                        <p class="text text-danger" id="message"></p>
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
        const LOGIN_ROUTE = "{{ route('asset.update') }}";
        const COMMITTE_ROUTE ="{{ route('asset.index') }}";
    </script>

    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="{{ asset('../../plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('../../dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/dist/js/ajax/editasset.js') }}"></script>

@endpush
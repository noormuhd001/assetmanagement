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
                    <form method="POST" action="{{ route('asset.update') }}">
                        @csrf

                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="{{ $asset->id }}">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $asset->name }}"  >

                             @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category"
                                value="{{ $asset->category }}" >

                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="model">Model</label>
                            <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model"
                                value="{{ $asset->model }}" >

                            @error('model')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>




@endsection

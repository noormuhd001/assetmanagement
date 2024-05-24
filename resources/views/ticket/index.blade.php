@extends('layout.layout')

@section('content')

@section('breadcrumbs')
    {{ Breadcrumbs::render('ticket.raise') }}
@endsection

@push('style')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2500 // milliseconds
        });
    </script>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Ticket</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ticket.submit') }}">
                        @csrf
                    
                    
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                            
                        </div>
                    
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="product">Product</label>
                            <select class="form-control" id="product" name="product" value="{{ old('email') }}">
                                <option value="">Select Product</option>
                                @foreach ($asset as $assets)
                                    <option value="{{ $assets->name }}" {{ old('product') == $assets->name ? 'selected' : '' }}>{{ $assets->name }}</option>
                                @endforeach
                            </select>
                            @error('product')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="4" >{{ old('message') }}</textarea>
                            @error('message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

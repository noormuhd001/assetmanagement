@extends('layout.layout')
@section('content')

@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('breadcrumbs')
    {{ Breadcrumbs::render('employee.notification') }}
@endsection
<div class="container">
    <div class="row">
        @foreach ($notification as $notifications)
            <div class="col-12 mb-3">
                <div class="notification">
                    <strong>message:</strong> {{ $notifications->data }}
                    <p> {{ $notifications->type }}</p>
                    <a href="{{ route('markAsRead', ['notification' => $notifications->id]) }}">
                        <button class="btn btn-primary">Mark as Read</button>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

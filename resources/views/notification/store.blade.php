@extends('layout.layout')

@section('content')


@section('breadcrumbs')

{{ Breadcrumbs::render('notification.index') }}
@endsection


    <h1>Notification Sent</h1>
    <p>{{ $messages['message'] }}</p>
    {{-- <p>{{ $messages['wish'] }}</p> --}}



@endsection
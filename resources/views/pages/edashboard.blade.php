@extends('layout.layout')


@section('content')



@section('breadcrumbs')
    {{ Breadcrumbs::render('edashboard') }}
@endsection



<div class="content-wrapper">

    <h4>Welcome to the website {{ $username }} </h4>

</div>


@endsection

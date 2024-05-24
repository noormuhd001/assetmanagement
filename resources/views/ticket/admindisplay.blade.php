@extends('layout.layout')


@section('content')

@section('breadcrumbs')
    {{ Breadcrumbs::render('ticket.admindisplay') }}
@endsection

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ticket Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ticket as $tickets)
                        <tr>
                            <td>{{ $tickets->id }}</td>
                            <td>{{ $tickets->name }}</td>
                            <td>{{ $tickets->email }}</td>
                            <td>{{ $tickets->subject }}</td>
                            <td>
                                @if ($tickets->status == 1)
                                    Opened
                                @elseif($tickets->status == 2)
                                    Closed
                                @else
                                    On Hold
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('ticket.adminshow', ['id' => $tickets->id]) }}"
                                    class="btn btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

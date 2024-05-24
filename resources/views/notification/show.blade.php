@extends('layout.layout')

@section('content')

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
                    <a href="{{ route('ticket.show', ['id' => $notifications->ticket_id]) }}">
                        <button class="btn btn-primary" onclick="markAsRead({{ $notifications->id }})">Mark as Read</button>
                    </a>    
            </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    function markAsRead(notificationId) {
        const url = `/notifications/${notificationId}/read`;
        console.log("URL:", url); // Debug the URL

        fetch(url, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            console.log("Response:", response); // Debug the response
            return response.json();
        })
        .then(data => {
            console.log("Data:", data); // Debug the data
            if (data.message === 'Notification marked as read.') {
                location.reload(); // Refresh the page
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>


@endsection

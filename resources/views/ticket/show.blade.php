@extends('layout.layout')
@section('content')
@section('breadcrumbs')
    {{ Breadcrumbs::render('ticket.show', $ticket->id) }}
@endsection
@push('style')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ticket Details</div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $ticket->name }}</p>
                    <p><strong>Email:</strong> {{ $ticket->email }}</p>
                    <p><strong>Product:</strong> {{ $ticket->subject }}</p>
                    <p><strong>Message:</strong> {{ $ticket->message }}</p>
                    <hr>
                    <h4>Messages</h4>
                    @foreach ($messages as $message)
                        <div>
                            <strong>{{ $message->sender }}:</strong>
                            <p>{{ $message->message }}</p>
                        </div>
                        <hr>
                    @endforeach
                    @if ($ticket->status != 2)
                        <form method="POST" id="employeereply">
                            @csrf
                            <div class="form-group">
                                <label for="message">Reply:</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Send Reply</button>
                            <p class="text text-danger" id="message"></p>
                        </form>
                    @else
                        <p>The ticket is closed and cannot be replied </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        const LOGIN_ROUTE = "{{ route('ticket.reply', $ticket->id) }}";
       
    </script>
              
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="{{ asset('../../plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('../../dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/dist/js/ajax/employeereply.js') }}"></script>
@endpush

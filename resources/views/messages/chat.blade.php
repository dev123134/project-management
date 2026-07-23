@extends('adminlte::page')

@section('title', 'Chat')

@section('content')

<h3>Chat With {{ $user->name }} ({{ ucfirst($user->role) }})</h3>

<div class="card">
    <div class="card-body" style="height:400px; overflow-y:auto;">

        @foreach($messages as $message)

            @if($message->sender_id == auth()->id())

                <div class="text-right mb-3">
                    <span class="badge bg-success p-2">
                        {{ $message->message }}
                    </span>

                    @if($message->file)
                        <br>
                        <a href="{{ asset('uploads/'.$message->file) }}" target="_blank">
                            📎 Download File
                        </a>
                    @endif

                    <br>

                    <small>
                        {{ $message->created_at->format('d-m-Y H:i') }}
                    </small>
                </div>

            @else

                <div class="text-left mb-3">
                    <span class="badge bg-primary p-2">
                        {{ $message->message }}
                    </span>

                    @if($message->file)
                        <br>
                        <a href="{{ asset('uploads/'.$message->file) }}" target="_blank">
                            📎 Download File
                        </a>
                    @endif

                    <br>

                    <small>
                        {{ $message->created_at->format('d-m-Y H:i') }}
                    </small>
                </div>

            @endif

        @endforeach

    </div>
</div>

<form action="/chat/send" method="POST" enctype="multipart/form-data">

    @csrf

    <input type="hidden" name="receiver_id" value="{{ $user->id }}">

    <div class="row mt-3">

        <div class="col-md-10">
            <input type="text"
                   name="message"
                   class="form-control"
                   placeholder="Type your message..."
                   required>

            <input type="file"
                   name="file"
                   class="form-control mt-2">
        </div>

        <div class="col-md-2">
            <button class="btn btn-success w-100">
                Send
            </button>
        </div>

    </div>

</form>
<!-- <script>
setInterval(function(){

    location.reload();

}, 3000);
</script> -->
@stop
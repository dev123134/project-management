@extends('adminlte::page')

@section('content')

<h2>{{ $group->name }}</h2>

<div class="card">
    <div class="card-body">

        @foreach($messages as $message)

        <p>
            <strong>
                {{ optional($message->user)->name }}
            </strong>

            :

            {{ $message->message }}

            @if($message->file)
            <br>

            <a href="{{ asset('uploads/'.$message->file) }}"
                target="_blank">
                📎 Download File
            </a>
            @endif
        </p>

        @endforeach

    </div>
</div>

<form action="/groups/{{ $group->id }}/send"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <input type="text"
        name="message"
        class="form-control"
        placeholder="Type Message">

    <br>

    <input type="file"
        name="file"
        class="form-control mt-2">

    <br>

    <button class="btn btn-success">
        Send
    </button>

</form>
<!-- <script>
setInterval(function(){

    location.reload();

}, 3000);
</script> -->
@stop
@extends('adminlte::page')

@section('content')

<h2>Send Message</h2>

<form action="/messages/store" method="POST">

    @csrf

    <div class="mb-3">
        <label>Select User</label>

        <select name="receiver_id" class="form-control">

            @foreach($users as $user)

                <option value="{{ $user->id }}">
                    {{ $user->name }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="mb-3">
        <label>Message</label>

        <textarea name="message"
                  class="form-control"></textarea>
    </div>

    <button class="btn btn-success">
        Send Message
    </button>

</form>

@stop
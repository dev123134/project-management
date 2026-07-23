@extends('adminlte::page')

@section('title', 'View Conversation')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Conversation

            <br>

            <small>

                {{ $sender->name }}

                ↔

                {{ $receiver->name }}

            </small>

        </h3>

    </div>

    <div class="card-body">

        @forelse($messages as $message)

            <div class="border rounded p-3 mb-3">

                <strong>

                    {{ $message->sender->name }}

                </strong>

                <br>

                {{ $message->message }}

                <br><br>

                @if($message->file)

                    <a href="{{ asset('uploads/'.$message->file) }}"
                       target="_blank">

                        📎 Download Attachment

                    </a>

                    <br><br>

                @endif

                <small class="text-muted">

                    {{ $message->created_at->format('d M Y h:i A') }}

                </small>

            </div>

        @empty

            <p>No Messages Found.</p>

        @endforelse

    </div>

</div>

@endsection
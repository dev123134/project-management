@extends('adminlte::page')

@section('title', 'Group Conversation')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Group Conversation

            <br>

            <small>

                {{ $group->name }}

            </small>

        </h3>

    </div>

    <div class="card-body">

        @forelse($messages as $message)

            <div class="border rounded p-3 mb-3">

                <strong>

                    {{ optional($message->user)->name ?? 'Deleted User' }}

                </strong>

                <br><br>

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

            <div class="alert alert-info">

                No Messages Found.

            </div>

        @endforelse

    </div>

</div>

@endsection
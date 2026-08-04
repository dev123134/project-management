@extends('adminlte::page')

@section('title', 'Chat')

@section('content_header')
<h1>Recent Chats</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-comments"></i>

            Chats

        </h3>

    </div>

    <div class="card-body p-0">

        @forelse($users as $user)

            <a href="/chat/{{ $user->id }}"
               class="text-decoration-none text-dark">

                <div class="d-flex justify-content-between align-items-center p-3 border-bottom
                    {{ $user->has_unread ? 'bg-light' : '' }}">

                    <div>

                        <h5 class="mb-1">

                            @if($user->has_unread)

                                <strong>{{ $user->name }}</strong>

                                <span class="badge bg-danger ms-2">
                                    New
                                </span>

                            @else

                                {{ $user->name }}

                            @endif

                        </h5>

                        <small class="text-muted">

                            {{ ucfirst($user->role) }}

                        </small>

                        <br>

                        @if($user->last_message)

                            <small>

                                {{ \Illuminate\Support\Str::limit($user->last_message->message,40) }}

                            </small>

                        @endif

                    </div>

                    <div class="text-end">

                        @if($user->last_message)

                            <small class="text-muted">

                                {{ $user->last_message->created_at->format('d M h:i A') }}

                            </small>

                        @endif

                    </div>

                </div>

            </a>

        @empty

            <div class="p-5 text-center">

                No Users Found

            </div>

        @endforelse

    </div>

</div>

@stop
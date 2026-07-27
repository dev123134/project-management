@extends('adminlte::page')

@section('title', 'All Task Comments')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>All Task Comments</h3>
    </div>

    <div class="card-body">

        @forelse($comments as $comment)

        <div class="card mb-3">

            <div class="card-body">

                <h5 class="mb-2">
                    <span class="text-muted">
                        Task Name :
                    </span>

                    <strong>
                        {{ $comment->task->title }}
                    </strong>
                </h5>

                <strong>
                    {{ $comment->user->name }}
                </strong>

                <span class="badge badge-primary ml-2">
                    {{ ucfirst($comment->user->role) }}
                </span>

                <small class="text-muted">
                    {{ $comment->created_at->diffForHumans() }}
                </small>

                <p class="mt-2">
                    {{ $comment->comment }}
                </p>

            </div>

        </div>

        @empty

        <p>No comments found.</p>

        @endforelse

    </div>

</div>

@endsection
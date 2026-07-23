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

                    <h5>
                        {{ $comment->task->title }}
                    </h5>

                    <strong>
                        {{ $comment->user->name }}
                    </strong>

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
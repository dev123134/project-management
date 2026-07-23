@extends('adminlte::page')

@section('title', 'Task Comments')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>
            Task Comments -
            {{ $task->title }}
        </h3>
    </div>

    <div class="card-body">

        <form action="{{ route('tasks.comments.store', $task->id) }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <textarea
                    name="comment"
                    class="form-control"
                    rows="3"
                    placeholder="Write comment..."
                    required></textarea>

            </div>

            <button class="btn btn-primary">
                Add Comment
            </button>

        </form>

        <hr>

        @forelse($comments as $comment)

            <div class="card mb-2">

                <div class="card-body">

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
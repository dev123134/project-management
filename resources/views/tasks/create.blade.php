@extends('adminlte::page')

@section('title', 'Create Task')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Create Task</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Project</label>
                <select name="project_id" class="form-control">
                    <option value="">Select Project</option>

                    @foreach($projects as $project)
                    <option value="{{ $project->id }}">
                        {{ $project->title }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Task Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Assign To</label>
                <select name="assigned_to" class="form-control">

                    @foreach($users as $user)

                    <option value="{{ $user->id }}">
                        {{ $user->name }} ({{ ucfirst($user->role) }})
                    </option>

                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label>Priority</label>
                <select name="priority" class="form-control">
                    <option>Low</option>
                    <option>Medium</option>
                    <option>High</option>
                    <option>Urgent</option>
                </select>
            </div>
<div class="mb-3">
    <label>Assigned Date</label>

    <input type="date"
           name="assigned_date"
           class="form-control"
           value="{{ date('Y-m-d') }}">
</div>
            <div class="mb-3">
                <label>Due Date</label>
                <input type="date" name="due_date" class="form-control">
            </div>
            <div class="mb-3">
                <label>GitHub Link</label>

                <input type="url"
                    name="github_link"
                    class="form-control"
                    placeholder="https://github.com/username/repository">

                <small class="text-muted">
                    Optional - Repository / Commit / Pull Request Link
                </small>
            </div>
            <button type="submit" class="btn btn-primary">
                Create Task
            </button>

        </form>

    </div>
</div>
@endsection
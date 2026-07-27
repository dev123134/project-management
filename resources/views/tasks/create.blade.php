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
                <label>Due Date</label>
                <input type="date" name="due_date" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">
                Create Task
            </button>

        </form>

    </div>
</div>
@endsection
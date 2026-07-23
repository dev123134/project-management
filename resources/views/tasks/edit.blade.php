@extends('adminlte::page')

@section('title', 'Edit Task')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Edit Task</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">

            @csrf
            @method('PUT')

            {{-- Project --}}
            <div class="mb-3">
                <label>Project</label>

                <select name="project_id" class="form-control">

                    @foreach($projects as $project)

                        <option value="{{ $project->id }}"
                            {{ $task->project_id == $project->id ? 'selected' : '' }}>

                            {{ $project->title }}

                        </option>

                    @endforeach

                </select>
            </div>

            {{-- Task Title --}}
            <div class="mb-3">
                <label>Task Title</label>

                <input type="text"
                       name="title"
                       value="{{ $task->title }}"
                       class="form-control">
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label>Description</label>

                <textarea name="description"
                          rows="4"
                          class="form-control">{{ $task->description }}</textarea>
            </div>

            {{-- Assign To --}}
            <div class="mb-3">
                <label>Assign To</label>

                <select name="assigned_to" class="form-control">

                    @foreach($users as $user)

                        <option value="{{ $user->id }}"
                            {{ $task->assigned_to == $user->id ? 'selected' : '' }}>

                            {{ $user->name }}

                        </option>

                    @endforeach

                </select>
            </div>

            {{-- Priority --}}
            <div class="mb-3">
                <label>Priority</label>

                <select name="priority" class="form-control">

                    <option value="Low"
                        {{ $task->priority == 'Low' ? 'selected' : '' }}>
                        Low
                    </option>

                    <option value="Medium"
                        {{ $task->priority == 'Medium' ? 'selected' : '' }}>
                        Medium
                    </option>

                    <option value="High"
                        {{ $task->priority == 'High' ? 'selected' : '' }}>
                        High
                    </option>

                    <option value="Urgent"
                        {{ $task->priority == 'Urgent' ? 'selected' : '' }}>
                        Urgent
                    </option>

                </select>
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label>Status</label>

                <select name="status" class="form-control">

                    <option value="Pending"
                        {{ $task->status == 'Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="In Progress"
                        {{ $task->status == 'In Progress' ? 'selected' : '' }}>
                        In Progress
                    </option>

                    <option value="Completed"
                        {{ $task->status == 'Completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                </select>
            </div>

            {{-- Due Date --}}
            <div class="mb-3">
                <label>Due Date</label>

                <input type="date"
                       name="due_date"
                       value="{{ $task->due_date }}"
                       class="form-control">
            </div>

            {{-- Buttons --}}
            <div class="mt-3">

                <button type="submit" class="btn btn-primary">
                    Update Task
                </button>

                <a href="{{ route('tasks.index') }}"
                   class="btn btn-secondary">
                    Back
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
@extends('adminlte::page')

@section('title', 'All Tasks')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>All Tasks</h3>
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project</th>
                        <th>Task</th>
                        <th>Assigned To</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($tasks as $task)

                    <tr>

                        <td>{{ $task->id }}</td>

                        <td>{{ $task->project->title ?? '-' }}</td>

                        <td>{{ $task->title }}</td>

                        <td>{{ $task->assignee->name ?? '-' }}</td>

                        <td>{{ $task->priority }}</td>

                        <td>

                            @if($task->status == 'Pending')

                            <span class="badge bg-warning">
                                Pending
                            </span>

                            @elseif($task->status == 'In Progress')

                            <span class="badge bg-primary">
                                In Progress
                            </span>

                            @elseif($task->status == 'Completed')

                            <span class="badge bg-success">
                                Completed
                            </span>

                            @endif

                        </td>

                        <td>{{ $task->due_date }}</td>

                        <td>

                            @if(auth()->user()->role == 'admin')

                            <a href="{{ route('tasks.edit', $task->id) }}"
                                class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <form action="{{ route('tasks.destroy', $task->id) }}"
                                method="POST"
                                style="display:inline-block">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-sm btn-danger">
                                    Delete
                                </button>

                            </form>

                            @endif

                            <a href="{{ route('tasks.comments', $task->id) }}"
                                class="btn btn-sm btn-info">
                                Comments
                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center">
                            No Tasks Found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

</div>

</div>

@endsection
@extends('adminlte::page')

@section('title', 'All Tasks')

@section('content')

<div class="card">
    <!-- 
    <div class="card-header">
        <h3>Assigned Tasks</h3>
    </div> -->

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

                            <form action="{{ route('tasks.updateStatus', $task->id) }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <select name="status"
                                    class="form-control form-control-sm"
                                    onchange="this.form.submit()">

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

                            </form>

                        </td>

                        <td>{{ $task->due_date }}</td>

                        <td>

                            <a href="{{ route('tasks.comments', $task->id) }}"
                                class="btn btn-sm btn-info">
                                Comments
                            </a>

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
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>

                            </form>

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
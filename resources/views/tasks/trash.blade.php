@extends('adminlte::page')

@section('title', 'Trash Tasks')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Trash Tasks</h3>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Project</th>
                    <th>Task Title</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Deleted At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($tasks as $task)

                <tr>

                    <td>{{ $task->id }}</td>

                    <td>
                        {{ $task->project->title ?? '-' }}
                    </td>

                    <td>
                        {{ $task->title }}
                    </td>

                    <td>
                        {{ $task->priority }}
                    </td>

                    <td>
                        {{ $task->status }}
                    </td>

                    <td>
                        {{ $task->deleted_at }}
                    </td>

                    <td>

                        <a href="{{ route('tasks.restore',$task->id) }}"
                           class="btn btn-success btn-sm">

                            Restore

                        </a>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="text-center">
                        No Deleted Tasks Found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
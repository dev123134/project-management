@extends('adminlte::page')

@section('title','Task Attachments')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Task Attachments</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('task.attachments.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-3">

                <label>Task</label>

                <select name="task_id"
                        class="form-control">

                    @foreach($tasks as $task)

                        <option value="{{ $task->id }}">
                            {{ $task->title }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Choose File</label>

                <input type="file"
                       name="file"
                       class="form-control"
                       required>

            </div>

            <button class="btn btn-primary">
                Upload File
            </button>

        </form>

        <hr>

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>Task</th>
                    <th>Uploaded By</th>
                    <th>File</th>
                </tr>

            </thead>

            <tbody>

                @foreach($attachments as $attachment)

                <tr>

                    <td>
                        {{ $attachment->task->title }}
                    </td>

                    <td>
                        {{ $attachment->user->name }}
                    </td>

                    <td>

                        <a href="{{ asset('storage/'.$attachment->file_path) }}"
                           target="_blank">

                            {{ $attachment->file_name }}

                        </a>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
@extends('adminlte::page')

@section('content')

<h2>Add Milestone</h2>

<form action="/milestones/store" method="POST">

    @csrf

    <div class="mb-3">
        <label>Project</label>

        <select name="project_id" class="form-control">

            @foreach($projects as $project)

                <option value="{{ $project->id }}">
                    {{ $project->title }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="mb-3">
        <label>Milestone Title</label>

        <input type="text"
               name="title"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>

        <textarea name="description"
                  class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Due Date</label>

        <input type="date"
               name="due_date"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Status</label>

        <select name="status" class="form-control">

            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>

        </select>
    </div>

    <button class="btn btn-success">
        Save Milestone
    </button>

</form>

@stop
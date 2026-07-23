@extends('adminlte::page')

@section('content')

<h2>Add Daily Update</h2>

<form action="/daily-updates/store" method="POST">

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
        <label>Today's Work</label>
        <textarea name="work_update" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Date</label>
        <input type="date" name="work_date" class="form-control">
    </div>

    <button class="btn btn-success">
        Submit Update
    </button>

</form>

@stop
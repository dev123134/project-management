@extends('adminlte::page')

@section('title', 'Milestones')

@section('content_header')
    <h1>Milestones List</h1>
@stop

@section('content')
<a href="/milestones/create" class="btn btn-success mb-3">
    + Add Milestone
</a>
<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Project ID</th>
            <th>Title</th>
            <th>Status</th>
            <th>Due Date</th>
        </tr>
    </thead>

    <tbody>

    @foreach($milestones as $milestone)

        <tr>
            <td>{{ $milestone->id }}</td>
            <td>{{ $milestone->project_id }}</td>
            <td>{{ $milestone->title }}</td>
            <td>{{ $milestone->status }}</td>
            <td>{{ $milestone->due_date }}</td>
        </tr>

    @endforeach

    </tbody>

</table>

@stop
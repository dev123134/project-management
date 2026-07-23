@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')
<h1>Projects List</h1>
@stop

@section('content')

<div class="mb-3 text-end ">
    <a href="/projects/create" class="btn btn-success">
        <i class="fas fa-plus"></i> Add Project
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Budget</th>
            <th>Status</th>
            <th>Deadline</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($projects as $project)

        <tr>
            <td>{{ $project->id }}</td>
            <td>{{ $project->title }}</td>
            <td>{{ $project->budget }}</td>
            <td>{{ $project->status }}</td>
            <td>{{ $project->deadline }}</td>

            <td>
                <a href="/projects/edit/{{ $project->id }}" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="/projects/delete/{{ $project->id }}"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure?')">
                    Delete
                </a>
                <a href="/projects/team/{{ $project->id }}"
                    class="btn btn-info btn-sm">
                    Team
                </a>
            </td>
        </tr>

        @endforeach

    </tbody>

</table>

@stop
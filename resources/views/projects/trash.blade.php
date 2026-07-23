@extends('adminlte::page')

@section('title', 'Trash Projects')

@section('content_header')
<h1>Trash Projects</h1>
@stop

@section('content')

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Project</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

    @foreach($projects as $project)

    <tr>

        <td>{{ $project->id }}</td>

        <td>{{ $project->title }}</td>

        <td>

            <a href="/projects/restore/{{ $project->id }}"
               class="btn btn-success btn-sm">
               Restore
            </a>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

@stop
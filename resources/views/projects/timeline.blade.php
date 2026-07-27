@extends('adminlte::page')

@section('title', 'Project Timeline')

@section('content_header')
<h1>Project Timeline</h1>
@stop

@section('content')

<div class="table-responsive">

    <table class="table table-bordered table-hover">

        <thead>

            <tr>
                <th>Project</th>
                <th>Start Date</th>
                <th>Deadline</th>
                <th>Days Remaining</th>
            </tr>

        </thead>

        <tbody>

            @foreach($projects as $project)

            <tr>

                <td>{{ $project->title }}</td>

                <td>{{ $project->start_date }}</td>

                <td>{{ $project->deadline }}</td>

                <td>
                    {{ (int) \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($project->deadline), false) }}
                    Days
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>
@stop
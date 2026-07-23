@extends('adminlte::page')

@section('title', 'Project Progress')

@section('content_header')
    <h1>Project Progress</h1>
@stop

@section('content')

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Project</th>
            <th>Progress</th>
        </tr>
    </thead>

    <tbody>
    @foreach($projects as $project)
        @php
            $total = \App\Models\Milestone::where('project_id', $project->id)->count();

            $completed = \App\Models\Milestone::where('project_id', $project->id)
                ->where('status', 'Completed')
                ->count();

            $progress = $total > 0
                ? round(($completed / $total) * 100)
                : 0;
        @endphp

        <tr>
            <td>{{ $project->title }}</td>
            <td>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width: {{ $progress }}%;">
                        {{ $progress }}%
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop
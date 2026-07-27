@extends('adminlte::page')

@section('title', 'Activity Logs')

@section('content_header')
    <h1>Activity Logs</h1>
@stop

@section('content')

<div class="table-responsive">

    <table class="table table-bordered table-hover">

        <thead>

            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Action</th>
                <th>Date</th>
            </tr>

        </thead>

        <tbody>

            @foreach($logs as $log)

            <tr>

                <td>{{ $log->id }}</td>

                <td>{{ $log->user_id }}</td>

                <td>{{ $log->action }}</td>

                <td>{{ $log->created_at->format('d-m-Y') }}</td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@stop
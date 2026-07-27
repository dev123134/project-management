@extends('adminlte::page')

@section('content')

<h2>Daily Updates</h2>

<a href="/daily-updates/create" class="btn btn-success mb-3">
    Add Daily Update
</a>

<div class="table-responsive">

    <table class="table table-bordered table-hover">

        <thead>

            <tr>
                <th>Project</th>
                <th>Today's Work</th>
                <th>Date</th>
            </tr>

        </thead>

        <tbody>

            @foreach($updates as $update)

            <tr>

                <td>{{ $update->project_id }}</td>

                <td>{{ $update->work_update }}</td>

                <td>{{ $update->work_date }}</td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@stop
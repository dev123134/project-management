@extends('adminlte::page')

@section('title','Daily Work Details')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">

            <h2>

                <i class="fas fa-tasks"></i>

                Daily Work Details

            </h2>

        </div>

        <div class="col-md-6 text-right">

            <a href="{{ route('admin.reports.daily-work-report') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Back

            </a>

        </div>

    </div>

    <div class="card card-primary">

        <div class="card-header">

            <h3 class="card-title">

                Daily Work Information

            </h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Project</th>
                    <td>{{ optional($dailyWork->project)->title ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>User</th>
                    <td>{{ optional($dailyWork->user)->name ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>User Email</th>
                    <td>{{ optional($dailyWork->user)->email ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Work Date</th>
                    <td>{{ \Carbon\Carbon::parse($dailyWork->work_date)->format('d M Y') }}</td>
                </tr>

                <tr>
                    <th>Submitted At</th>
                    <td>{{ $dailyWork->created_at->format('d M Y h:i A') }}</td>
                </tr>

                <tr>
                    <th>Work Update</th>
                    <td>{{ $dailyWork->work_update }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection
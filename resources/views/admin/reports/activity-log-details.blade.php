@extends('adminlte::page')

@section('title','Activity Log Details')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">

            <h2>

                <i class="fas fa-history"></i>

                Activity Log Details

            </h2>

        </div>

        <div class="col-md-6 text-right">

            <a href="{{ route('admin.reports.activity-log-report') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Back

            </a>

        </div>

    </div>

    <div class="card card-primary">

        <div class="card-header">

            <h3 class="card-title">

                Activity Information

            </h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="30%">User</th>

                    <td>{{ optional($activityLog->user)->name ?? 'N/A' }}</td>

                </tr>

                <tr>

                    <th>Email</th>

                    <td>{{ optional($activityLog->user)->email ?? 'N/A' }}</td>

                </tr>

                <tr>

                    <th>Role</th>

                    <td>{{ optional($activityLog->user)->role ?? 'N/A' }}</td>

                </tr>

                <tr>

                    <th>Activity</th>

                    <td>{{ $activityLog->action }}</td>

                </tr>

                <tr>

                    <th>Date</th>

                    <td>{{ $activityLog->created_at->format('d M Y') }}</td>

                </tr>

                <tr>

                    <th>Time</th>

                    <td>{{ $activityLog->created_at->format('h:i A') }}</td>

                </tr>

            </table>

        </div>

    </div>

</div>

@endsection
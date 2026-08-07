@extends('adminlte::page')

@section('title','Activity Log Report')

@section('content')

<div class="container-fluid">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

        <h2 class="mb-2 mb-md-0">

            <i class="fas fa-history"></i>

            Activity Log Report

        </h2>

        <div class="d-flex flex-wrap gap-2">

            <a href="{{ route('admin.reports.activity-log.pdf') }}"
                class="btn btn-danger">

                <i class="fas fa-file-pdf"></i>

                PDF Export

            </a>

            <a href="{{ route('admin.reports.activity-log.csv') }}"
                class="btn btn-success">

                <i class="fas fa-file-excel"></i>

                CSV Export

            </a>

            <!-- <a href="{{ url()->previous() }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Back

        </a> -->

        </div>

    </div>

    <div class="row">

        <div class="col-md-4">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>{{ $totalLogs }}</h3>

                    <p>Total Logs</p>

                </div>

                <div class="icon">

                    <i class="fas fa-history"></i>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>{{ $todayLogs }}</h3>

                    <p>Today's Logs</p>

                </div>

                <div class="icon">

                    <i class="fas fa-calendar-day"></i>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-warning">

                <div class="inner">

                    <h3>{{ $thisMonthLogs }}</h3>

                    <p>This Month</p>

                </div>

                <div class="icon">

                    <i class="fas fa-calendar-alt"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="card card-primary">

        <div class="card-header">

            <h3 class="card-title">

                Search & Filter

            </h3>

        </div>

        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-5">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search Activity"
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-3">

                        <select
                            name="user"
                            class="form-control">

                            <option value="">All Users</option>

                            @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ request('user') == $user->id ? 'selected' : '' }}>

                                {{ $user->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-2">

                        <input
                            type="date"
                            name="date"
                            class="form-control"
                            value="{{ request('date') }}">

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary">

                            Search

                        </button>

                        <a
                            href="{{ route('admin.reports.activity-log-report') }}"
                            class="btn btn-secondary">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                Activity Log List

            </h3>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>User</th>

                        <th>Role</th>

                        <th>Activity</th>

                        <th>Date & Time</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($activityLogs as $log)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ optional($log->user)->name }}</td>

                        <td>{{ optional($log->user)->role }}</td>

                        <td>{{ Str::limit($log->action,60) }}</td>

                        <td>{{ $log->created_at->format('d M Y h:i A') }}</td>

                        <td>

                            <a
                                href="{{ route('admin.reports.activity-log-details',$log->id) }}"
                                class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                                View

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center text-danger">

                            No Activity Logs Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer">

            {{ $activityLogs->links('pagination::bootstrap-4') }}

        </div>

    </div>

</div>

@endsection
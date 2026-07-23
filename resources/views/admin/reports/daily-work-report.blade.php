@extends('adminlte::page')

@section('title','Daily Work Report')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">

            <h2>

                <i class="fas fa-tasks"></i>

                Daily Work Report

            </h2>

        </div>

    </div>

    <div class="row">

        <div class="col-md-4">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>{{ $totalWorks }}</h3>

                    <p>Total Updates</p>

                </div>

                <div class="icon">

                    <i class="fas fa-tasks"></i>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>{{ $todayWorks }}</h3>

                    <p>Today's Updates</p>

                </div>

                <div class="icon">

                    <i class="fas fa-calendar-day"></i>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-warning">

                <div class="inner">

                    <h3>{{ $thisMonthWorks }}</h3>

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

                    <div class="col-md-3">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search Work Update"
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-3">

                        <select
                            name="project"
                            class="form-control">

                            <option value="">All Projects</option>

                            @foreach($projects as $project)

                            <option
                                value="{{ $project->id }}"
                                {{ request('project') == $project->id ? 'selected' : '' }}>

                                {{ $project->title }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-2">

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

                        <a href="{{ route('admin.reports.daily-work-report') }}"
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

                Daily Work List

            </h3>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Project</th>

                        <th>User</th>

                        <th>Work Update</th>

                        <th>Date</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($dailyWorks as $work)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ optional($work->project)->title }}</td>

                        <td>{{ optional($work->user)->name }}</td>

                        <td>{{ Str::limit($work->work_update,50) }}</td>

                        <td>{{ \Carbon\Carbon::parse($work->work_date)->format('d M Y') }}</td>

                        <td>

                            <a href="{{ route('admin.reports.daily-work-details',$work->id) }}"
                                class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                                View

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center text-danger">

                            No Daily Work Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer">

            {{ $dailyWorks->links('pagination::bootstrap-4') }}

        </div>

    </div>

</div>

@endsection
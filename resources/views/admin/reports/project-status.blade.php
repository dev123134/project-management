@extends('adminlte::page')

@section('title','Project Status Report')

@section('content')

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-3">

            <div class="col-sm-6">
                <h3>
                    <i class="fas fa-tasks"></i>
                    Project Status Report
                </h3>
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">

                <div class="small-box bg-primary">

                    <div class="inner">

                        <h3>{{ $totalProjects }}</h3>

                        <p>Total Projects</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-folder-open"></i>
                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="small-box bg-warning">

                    <div class="inner">

                        <h3>{{ $pendingProjects }}</h3>

                        <p>Pending</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="small-box bg-info">

                    <div class="inner">

                        <h3>{{ $inProgressProjects }}</h3>

                        <p>In Progress</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-spinner"></i>
                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="small-box bg-success">

                    <div class="inner">

                        <h3>{{ $completedProjects }}</h3>

                        <p>Completed</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
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
                                placeholder="Search Project..."
                                value="{{ request('search') }}">

                        </div>

                        <div class="col-md-4">

                            <select
                                class="form-control"
                                name="status">

                                <option value="">All Status</option>

                                <option value="Pending"
                                    {{ request('status')=='Pending'?'selected':'' }}>
                                    Pending
                                </option>

                                <option value="In Progress"
                                    {{ request('status')=='In Progress'?'selected':'' }}>
                                    In Progress
                                </option>

                                <option value="Completed"
                                    {{ request('status')=='Completed'?'selected':'' }}>
                                    Completed
                                </option>

                            </select>

                        </div>

                        <div class="col-md-3">

                            <button class="btn btn-primary">

                                <i class="fas fa-search"></i>

                                Search

                            </button>

                            <a
                                href="{{ route('admin.reports.project-status') }}"
                                class="btn btn-secondary">

                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </div>

        </div>
        <div class="card card-outline card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    Project List

                </h3>

            </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Project Title</th>

                            <th>Start Date</th>

                            <th>Deadline</th>

                            <th>Budget</th>

                            <th>Status</th>

                            <th>Created</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($projects as $project)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>

                                <strong>{{ $project->title }}</strong>

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($project->deadline)->format('d-m-Y') }}

                            </td>

                            <td>

                                ₹ {{ number_format($project->budget,2) }}

                            </td>

                            <td>

                                @if($project->status=='Pending')

                                <span class="badge badge-warning">

                                    Pending

                                </span>

                                @elseif($project->status=='In Progress')

                                <span class="badge badge-primary">

                                    In Progress

                                </span>

                                @else

                                <span class="badge badge-success">

                                    Completed

                                </span>

                                @endif

                            </td>

                            <td>

                                {{ $project->created_at->format('d-m-Y') }}

                            </td>

                            <td>
                                <a href="{{ route('admin.reports.project-details', $project->id) }}"
                                    class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="8" class="text-center text-danger">

                                No Projects Found.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="card-footer clearfix">

                {{ $projects->links('pagination::bootstrap-4') }}

            </div>

        </div>

    </div>

</div>

@endsection
@extends('adminlte::page')

@section('title','Milestone Report')

@section('content')

<div class="container-fluid">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

        <h2 class="mb-2 mb-md-0">

            <i class="fas fa-flag-checkered"></i>

            Milestone Report

        </h2>

        <div class="d-flex flex-wrap gap-2">

            <a href="{{ route('admin.reports.milestone.pdf') }}"
                class="btn btn-danger">

                <i class="fas fa-file-pdf"></i>

                PDF Export

            </a>

            <a href="{{ route('admin.reports.milestone.csv') }}"
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

                    <h3>{{ $totalMilestones }}</h3>

                    <p>Total Milestones</p>

                </div>

                <div class="icon">

                    <i class="fas fa-flag"></i>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-warning">

                <div class="inner">

                    <h3>{{ $pendingMilestones }}</h3>

                    <p>Pending Milestones</p>

                </div>

                <div class="icon">

                    <i class="fas fa-hourglass-half"></i>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>{{ $completedMilestones }}</h3>

                    <p>Completed Milestones</p>

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
                            placeholder="Search Milestone"
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-4">

                        <select
                            name="status"
                            class="form-control">

                            <option value="">All Status</option>

                            <option value="Pending"
                                {{ request('status') == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="In Progress"
                                {{ request('status') == 'In Progress' ? 'selected' : '' }}>
                                In Progress
                            </option>
                            <option value="Completed"
                                {{ request('status') == 'Completed' ? 'selected' : '' }}>
                                Completed
                            </option>


                        </select>

                    </div>

                    <div class="col-md-3">

                        <button
                            class="btn btn-primary">

                            Search

                        </button>

                        <a
                            href="{{ route('admin.reports.milestone-report') }}"
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

                Milestone List

            </h3>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Project</th>

                        <th>Milestone</th>

                        <th>Due Date</th>

                        <th>Status</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($milestones as $milestone)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            {{ optional($milestone->project)->title ?? 'N/A' }}

                        </td>

                        <td>

                            {{ $milestone->title }}

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($milestone->due_date)->format('d M Y') }}

                        </td>

                        <td>

                            @if($milestone->status == 'Pending')

                            <span class="badge badge-warning">

                                Pending

                            </span>

                            @elseif($milestone->status == 'Completed')

                            <span class="badge badge-success">

                                Completed

                            </span>

                            @else

                            <span class="badge badge-info">

                                {{ $milestone->status }}

                            </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('admin.reports.milestone-details',$milestone->id) }}"
                                class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                                View

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center text-danger">

                            No Milestones Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer">

            {{ $milestones->links('pagination::bootstrap-4') }}

        </div>

    </div>

</div>

@endsection
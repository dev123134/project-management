@extends('adminlte::page')

@section('title','Project Details')

@section('content')

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-3">

            <div class="col-sm-6">

                <h3>

                    <i class="fas fa-folder-open"></i>

                    Project Details

                </h3>

            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('admin.reports.project-status') }}"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </a>

            </div>

        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="card card-primary">

                    <div class="card-header">

                        <h3 class="card-title">

                            Project Information

                        </h3>

                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <tr>

                                <th width="220">

                                    Project Title

                                </th>

                                <td>

                                    {{ $project->title }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Description

                                </th>

                                <td>

                                    {{ $project->description }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Budget

                                </th>

                                <td>

                                    ₹ {{ number_format($project->budget,2) }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Start Date

                                </th>

                                <td>

                                    {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Deadline

                                </th>

                                <td>

                                    {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Status

                                </th>

                                <td>

                                    @if($project->status=="Pending")

                                        <span class="badge badge-warning">

                                            Pending

                                        </span>

                                    @elseif($project->status=="In Progress")

                                        <span class="badge badge-primary">

                                            In Progress

                                        </span>

                                    @else

                                        <span class="badge badge-success">

                                            Completed

                                        </span>

                                    @endif

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Created At

                                </th>

                                <td>

                                    {{ $project->created_at->format('d M Y h:i A') }}

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card card-success">

                    <div class="card-header">

                        <h3 class="card-title">

                            Progress

                        </h3>

                    </div>

                    <div class="card-body">

                        <h2 class="text-center">

                            {{ $progress }}%

                        </h2>

                        <div class="progress progress-lg">

                            <div class="progress-bar bg-success"

                                 style="width:{{ $progress }}%">

                            </div>

                        </div>

                        <hr>

                        <div class="text-center">

                            @if($progress==100)

                                <span class="badge badge-success">

                                    Project Completed

                                </span>

                            @elseif($progress>=50)

                                <span class="badge badge-info">

                                    Work In Progress

                                </span>

                            @else

                                <span class="badge badge-warning">

                                    Project Started

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>
                <div class="row">

            <div class="col-md-6">

                <div class="card card-info">

                    <div class="card-header">

                        <h3 class="card-title">

                            <i class="fas fa-users"></i>

                            Team Members

                        </h3>

                    </div>

                    <div class="card-body table-responsive p-0">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Name</th>

                                    <th>Email</th>

                                    <th>Role</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($teamMembers as $member)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $member->name }}</td>

                                        <td>{{ $member->email }}</td>

                                        <td>

                                            <span class="badge badge-primary">

                                                {{ ucfirst($member->role) }}

                                            </span>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4" class="text-center text-danger">

                                            No Team Members Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="card card-warning">

                    <div class="card-header">

                        <h3 class="card-title">

                            <i class="fas fa-flag"></i>

                            Milestones

                        </h3>

                    </div>

                    <div class="card-body table-responsive p-0">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Title</th>

                                    <th>Due Date</th>

                                    <th>Status</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($milestones as $milestone)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>

                                            {{ $milestone->title }}

                                        </td>

                                        <td>

                                            {{ \Carbon\Carbon::parse($milestone->due_date)->format('d M Y') }}

                                        </td>

                                        <td>

                                            @if($milestone->status=="Pending")

                                                <span class="badge badge-warning">

                                                    Pending

                                                </span>

                                            @elseif($milestone->status=="Completed")

                                                <span class="badge badge-success">

                                                    Completed

                                                </span>

                                            @else

                                                <span class="badge badge-info">

                                                    {{ $milestone->status }}

                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4" class="text-center text-danger">

                                            No Milestones Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>
                <div class="row">

            <div class="col-md-6">

                <div class="card card-success">

                    <div class="card-header">

                        <h3 class="card-title">

                            <i class="fas fa-calendar-check"></i>

                            Daily Updates

                        </h3>

                    </div>

                    <div class="card-body table-responsive p-0">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Date</th>

                                    <th>Work Update</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($dailyUpdates as $update)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>

                                            {{ \Carbon\Carbon::parse($update->work_date)->format('d M Y') }}

                                        </td>

                                        <td>

                                            {{ $update->work_update }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="3" class="text-center text-danger">

                                            No Daily Updates Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="card card-danger">

                    <div class="card-header">

                        <h3 class="card-title">

                            <i class="fas fa-history"></i>

                            Activity Logs

                        </h3>

                    </div>

                    <div class="card-body table-responsive p-0">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>User ID</th>

                                    <th>Activity</th>

                                    <th>Date & Time</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($activityLogs as $log)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>

                                            {{ $log->user_id }}

                                        </td>

                                        <td>

                                            {{ $log->action }}

                                        </td>

                                        <td>

                                            {{ $log->created_at->format('d M Y h:i A') }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4" class="text-center text-danger">

                                            No Activity Logs Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
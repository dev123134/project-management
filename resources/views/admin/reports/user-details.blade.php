@extends('adminlte::page')

@section('title','User Details Report')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">

            <h2>

                <i class="fas fa-user"></i>

                User Details Report

            </h2>

        </div>

        <div class="col-md-6 text-right">

            <a href="{{ route('admin.reports.user-wise') }}"
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

                        User Information

                    </h3>

                </div>

                <div class="card-body">

                    <table class="table table-bordered">

                        <tr>

                            <th width="220">

                                Name

                            </th>

                            <td>

                                {{ $user->name }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Email

                            </th>

                            <td>

                                {{ $user->email }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Role

                            </th>

                            <td>

                                @if($user->role=="admin")

                                    <span class="badge badge-danger">

                                        Admin

                                    </span>

                                @elseif($user->role=="freelancer")

                                    <span class="badge badge-success">

                                        Freelancer

                                    </span>

                                @elseif($user->role=="employee")

                                    <span class="badge badge-primary">

                                        Employee

                                    </span>

                                @else

                                    <span class="badge badge-warning">

                                        Client

                                    </span>

                                @endif

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Registered On

                            </th>

                            <td>

                                {{ $user->created_at->format('d M Y h:i A') }}

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-info">

                <div class="inner">

                    <h3>

                        {{ $assignedProjects->count() }}

                    </h3>

                    <p>

                        Assigned Projects

                    </p>

                </div>

                <div class="icon">

                    <i class="fas fa-folder-open"></i>

                </div>

            </div>

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>

                        {{ $dailyUpdates->count() }}

                    </h3>

                    <p>

                        Daily Updates

                    </p>

                </div>

                <div class="icon">

                    <i class="fas fa-clipboard-list"></i>

                </div>

            </div>

        </div>

    </div>

        <div class="row">

        <div class="col-md-6">

            <div class="card card-primary">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-folder-open"></i>

                        Assigned Projects

                    </h3>

                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Project</th>

                                <th>Status</th>

                                <th>Deadline</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($assignedProjects as $project)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $project->title }}</td>

                                    <td>

                                        @if($project->status=="Pending")

                                            <span class="badge badge-warning">

                                                Pending

                                            </span>

                                        @elseif($project->status=="In Progress")

                                            <span class="badge badge-info">

                                                In Progress

                                            </span>

                                        @else

                                            <span class="badge badge-success">

                                                Completed

                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center text-danger">

                                        No Assigned Projects

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

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

                                        No Daily Updates

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <div class="card card-warning mt-3">

        <div class="card-header">

            <h3 class="card-title">

                <i class="fas fa-chart-line"></i>

                Performance Summary

            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 text-center">

                    <h3 class="text-primary">

                        {{ $assignedProjects->count() }}

                    </h3>

                    <p>

                        Total Projects

                    </p>

                </div>

                <div class="col-md-4 text-center">

                    <h3 class="text-success">

                        {{ $dailyUpdates->count() }}

                    </h3>

                    <p>

                        Daily Updates

                    </p>

                </div>

                <div class="col-md-4 text-center">

                    <h3 class="text-info">

                        {{
                            $assignedProjects->where('status','Completed')->count()
                        }}

                    </h3>

                    <p>

                        Completed Projects

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
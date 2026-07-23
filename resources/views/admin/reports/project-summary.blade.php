@extends('adminlte::page')

@section('title','Project Summary Report')

@section('content')

<div class="content-header">
    <div class="container-fluid">

        <h3 class="mb-4">
            <i class="fas fa-chart-pie"></i>
            Project Summary Report
            <a href="{{ route('admin.reports.project-summary.pdf') }}"
   class="btn btn-danger me-2 float-right">

    <i class="fas fa-file-pdf"></i>

    PDF Export

</a>    
        </h3>

        <div class="row">

            <div class="col-md-3">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $totalProjects }}</h3>
                        <p>Total Projects</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-folder"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $completedProjects }}</h3>
                        <p>Completed Projects</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $activeProjects }}</h3>
                        <p>Active Projects</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $delayedProjects }}</h3>
                        <p>Delayed Projects</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-3">

            <div class="col-md-4">

                <div class="card card-primary">

                    <div class="card-header">
                        Milestone Statistics
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <tr>
                                <th>Total Milestones</th>
                                <td>{{ $totalMilestones }}</td>
                            </tr>

                            <tr>
                                <th>Completed</th>
                                <td>{{ $completedMilestones }}</td>
                            </tr>

                            <tr>
                                <th>Overall Progress</th>
                                <td>

                                    <div class="progress">

                                        <div
                                            class="progress-bar bg-success"
                                            style="width: {{ $overallProgress }}%">

                                            {{ $overallProgress }}%

                                        </div>

                                    </div>

                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection
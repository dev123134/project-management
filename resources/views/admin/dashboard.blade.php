@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
<h1 class="mb-3">Admin Dashboard</h1>
@stop

@section('content')

<div class="row">

    <!-- Total Users -->
    <div class="col-xl col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
        <a href="#" class="dashboard-card">
            <div class="card dashboard-box">
                <div class="card-body d-flex align-items-center">
                    <div class="dashboard-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>

                    <div class="ml-3">
                        <small class="text-muted d-block">Total Users</small>

                        <h3 class="mb-1 font-weight-bold">{{ $totalUsers }}</h3>

                        <small>
                            @if($userGrowth >= 0)
                            <span class="text-success font-weight-bold">
                                <i class="fas fa-arrow-up"></i>
                                {{ number_format($userGrowth,1) }}%
                            </span>
                            @else
                            <span class="text-danger font-weight-bold">
                                <i class="fas fa-arrow-down"></i>
                                {{ number_format(abs($userGrowth),1) }}%
                            </span>
                            @endif

                            <span class="text-muted">from last month</span>
                        </small>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Total Projects -->
    <div class="col-xl col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
        <a href="#" class="dashboard-card">
            <div class="card dashboard-box">
                <div class="card-body d-flex align-items-center">
                    <div class="dashboard-icon bg-success">
                        <i class="fas fa-project-diagram"></i>
                    </div>

                    <div class="ml-3">
                        <small class="text-muted d-block">Total Projects</small>

                        <h3 class="mb-1 font-weight-bold">{{ $totalProjects }}</h3>

                        <small>
                            @if($projectGrowth >= 0)
                            <span class="text-success font-weight-bold">
                                <i class="fas fa-arrow-up"></i>
                                {{ number_format($projectGrowth,1) }}%
                            </span>
                            @else
                            <span class="text-danger font-weight-bold">
                                <i class="fas fa-arrow-down"></i>
                                {{ number_format(abs($projectGrowth),1) }}%
                            </span>
                            @endif

                            <span class="text-muted">from last month</span>
                        </small>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Total Clients -->
    <div class="col-xl col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
        <a href="#" class="dashboard-card">
            <div class="card dashboard-box">
                <div class="card-body d-flex align-items-center">
                    <div class="dashboard-icon bg-info">
                        <i class="fas fa-user-tie"></i>
                    </div>

                    <div class="ml-3">
                        <small class="text-muted d-block">Total Clients</small>

                        <h3 class="mb-1 font-weight-bold">{{ $totalClients }}</h3>

                        <small>
                            @if($clientGrowth >= 0)
                            <span class="text-success font-weight-bold">
                                <i class="fas fa-arrow-up"></i>
                                {{ number_format($clientGrowth,1) }}%
                            </span>
                            @else
                            <span class="text-danger font-weight-bold">
                                <i class="fas fa-arrow-down"></i>
                                {{ number_format(abs($clientGrowth),1) }}%
                            </span>
                            @endif

                            <span class="text-muted">from last month</span>
                        </small>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Total Tasks -->
    <div class="col-xl col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
        <a href="#" class="dashboard-card">
            <div class="card dashboard-box">
                <div class="card-body d-flex align-items-center">
                    <div class="dashboard-icon bg-warning">
                        <i class="fas fa-tasks text-white"></i>
                    </div>

                    <div class="ml-3">
                        <small class="text-muted d-block">Total Tasks</small>

                        <h3 class="mb-1 font-weight-bold">{{ $totalTasks }}</h3>

                        <small>
                            @if($taskGrowth >= 0)
                            <span class="text-success font-weight-bold">
                                <i class="fas fa-arrow-up"></i>
                                {{ number_format($taskGrowth,1) }}%
                            </span>
                            @else
                            <span class="text-danger font-weight-bold">
                                <i class="fas fa-arrow-down"></i>
                                {{ number_format(abs($taskGrowth),1) }}%
                            </span>
                            @endif

                            <span class="text-muted">from last month</span>
                        </small>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Total Revenue -->
    <div class="col-xl col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
        <a href="#" class="dashboard-card">
            <div class="card dashboard-box">
                <div class="card-body d-flex align-items-center">
                    <div class="dashboard-icon bg-danger">
                        <i class="fas fa-rupee-sign"></i>
                    </div>

                    <div class="ml-3">
                        <small class="text-muted d-block">Total Revenue</small>

                        <h2>
                            ₹{{ number_format($totalRevenue,2) }}
                        </h2>
                        <small>
                            @if($revenueGrowth >= 0)
                            <span class="text-success font-weight-bold">
                                <i class="fas fa-arrow-up"></i>
                                {{ number_format($revenueGrowth,1) }}%
                            </span>
                            @else
                            <span class="text-danger font-weight-bold">
                                <i class="fas fa-arrow-down"></i>
                                {{ number_format(abs($revenueGrowth),1) }}%
                            </span>
                            @endif

                            <span class="text-muted">from last month</span>
                        </small>
                    </div>
                </div>
            </div>
        </a>
    </div>

</div>
<div class="row mt-4">

    <div class="col-lg-6 mb-4">

        <div class="card shadow-sm border-0" style="min-height:450px;">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center w-100">

                <h5 class="mb-0 font-weight-bold">
                    Revenue Overview
                </h5>


                <select id="revenueFilter" class="custom-select custom-select-sm ml-auto" style="width:140px;">
                    <option value="this_month">This Month</option>
                    <option value="last_month">Last Month</option>
                    <option value="this_year">This Year</option>
                </select>


            </div>

            <div class="card-body">

                <h2 id="revenueAmount"  class="font-weight-bold text-dark">

                    ₹{{ number_format($totalRevenue,2) }}

                </h2>

                <small class="text-success">

                    <i class="fas fa-arrow-up"></i>

                    {{ number_format($revenueGrowth,1) }}%

                    from last month

                </small>

                <div class="mt-4" style="height:300px; width:100%;">
                    <canvas id="revenueChart"></canvas>
                </div>

            </div>

        </div>

    </div>
    <div class="col-lg-6 mb-4">

        <div class="card shadow-sm border-0" style="min-height:450px;">

            <div class="card-header bg-white border-0">
                <h5 class="mb-0 font-weight-bold">
                    Project Overview
                </h5>
            </div>

            <div class="card-body">

                <div class="row align-items-center">

                    <!-- Chart -->

                    <div class="col-md-6 text-center">

                        <div style="height:250px; position:relative;">

                            <canvas id="projectChart"></canvas>

                            <div id="projectCenterText"
                                style="
                                position:absolute;
                                top:50%;
                                left:50%;
                                transform:translate(-50%,-50%);
                                text-align:center;
                                pointer-events:none;
                             ">

                                <h2 class="font-weight-bold mb-0">
                                    {{ $totalProjects }}
                                </h2>

                                <small class="text-muted">
                                    Total
                                </small>

                            </div>

                        </div>

                    </div>

                    <!-- Status -->

                    <div class="col-md-6">

                        <div class="mb-4">

                            <span class="badge badge-success">&nbsp;</span>

                            <strong> Completed</strong>

                            <div class="text-muted ml-4">

                                {{ $completedProjects }}
                                ({{ $completedPercentage }}%)

                            </div>

                        </div>

                        <div class="mb-4">

                            <span class="badge badge-warning">&nbsp;</span>

                            <strong> In Progress</strong>

                            <div class="text-muted ml-4">

                                {{ $inProgressProjects }}
                                ({{ $inProgressPercentage }}%)

                            </div>

                        </div>

                        <div class="mb-4">

                            <span class="badge badge-danger">&nbsp;</span>

                            <strong> Pending</strong>

                            <div class="text-muted ml-4">

                                {{ $pendingProjects }}
                                ({{ $pendingPercentage }}%)

                            </div>

                        </div>

                        <a href="{{ url('/admin/project-monitoring') }}"
                            class="font-weight-bold">

                            View All Projects
                            <i class="fas fa-arrow-right ml-1"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
<div class="row mt-4">

    <div class="col-lg-6 mb-4">

        <div class="card shadow-sm border-0" style="min-height:400px;">

            <div class="card-header bg-white border-0 d-flex align-items-center">

                <h5 class="mb-0 font-weight-bold">
                    Tasks Overview
                </h5>

                <div class="ml-auto">
                    <select id="taskFilter"
                        class="custom-select custom-select-sm"
                        style="width:140px;">

                        <option value="this_week" selected>This Week</option>
                        <option value="this_month">This Month</option>
                        <option value="this_year">This Year</option>

                    </select>
                </div>

            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between mb-4">

                    <div class="text-muted font-weight-bold">
                        Total Tasks
                    </div>

                    <div class="font-weight-bold h5 mb-0">
                        <span id="totalTasks">
                            {{ $totalTaskCount }}
                        </span>
                    </div>

                </div>

                {{-- Completed --}}
                <div class="mb-4">

                    <div class="d-flex justify-content-between mb-2">

                        <span>Completed</span>

                        <span>
                            <span id="completedCount">{{ $completedTasks }}</span>
                            (<span id="completedPercentage">{{ $completedTaskPercentage }}</span>%)
                        </span>

                    </div>

                    <div class="progress" style="height:8px;border-radius:20px;">

                        <div id="completedBar"
                            class="progress-bar bg-success"
                            style="width:{{ $completedTaskPercentage }}%;">
                        </div>

                    </div>

                </div>

                {{-- In Progress --}}
                <div class="mb-4">

                    <div class="d-flex justify-content-between mb-2">

                        <span>In Progress</span>

                        <span>
                            <span id="progressCount">{{ $inProgressTasks }}</span>
                            (<span id="progressPercentage">{{ $inProgressTaskPercentage }}</span>%)
                        </span>

                    </div>

                    <div class="progress" style="height:8px;border-radius:20px;">

                        <div id="progressBar"
                            class="progress-bar bg-primary"
                            style="width:{{ $inProgressTaskPercentage }}%;">
                        </div>

                    </div>

                </div>

                {{-- Pending --}}
                <div class="mb-4">

                    <div class="d-flex justify-content-between mb-2">

                        <span>Pending</span>

                        <span>
                            <span id="pendingCount">{{ $pendingTasks }}</span>
                            (<span id="pendingPercentage">{{ $pendingTaskPercentage }}</span>%)
                        </span>

                    </div>

                    <div class="progress" style="height:8px;border-radius:20px;">

                        <div id="pendingBar"
                            class="progress-bar bg-warning"
                            style="width:{{ $pendingTaskPercentage }}%;">
                        </div>

                    </div>

                </div>

                <hr>

                <div class="text-right">

                    <a href="{{ url('/tasks') }}"
                        class="font-weight-bold">

                        View All Tasks

                        <i class="fas fa-arrow-right ml-1"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>
    <div class="col-lg-6 mb-4">

        <div class="card shadow-sm border-0" style="min-height:400px;">

            <div class="card-header bg-white border-0">
                <h5 class="mb-0 font-weight-bold">
                    Recent Activity
                </h5>
            </div>

            <div class="card-body p-0">

                @forelse($recentActivities as $activity)

                <div class="d-flex align-items-start px-3 py-3 border-bottom">

                    <div class="mr-3">

                        @if(Str::contains($activity->action,'Created Project'))

                        <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center"
                            style="width:40px;height:40px;">

                            <i class="fas fa-folder-plus"></i>

                        </div>

                        @elseif(Str::contains($activity->action,'Added Daily Update'))

                        <div class="rounded-circle bg-success text-white d-flex justify-content-center align-items-center"
                            style="width:40px;height:40px;">

                            <i class="fas fa-tasks"></i>

                        </div>

                        @else

                        <div class="rounded-circle bg-warning text-white d-flex justify-content-center align-items-center"
                            style="width:40px;height:40px;">

                            <i class="fas fa-history"></i>

                        </div>

                        @endif

                    </div>

                    <div class="flex-grow-1">

                        <div class="font-weight-bold">
                            {{ $activity->action }}
                        </div>

                        <small class="text-muted">

                            By {{ $activity->user->name }}

                        </small>

                    </div>

                    <small class="text-muted">

                        {{ $activity->created_at->diffForHumans() }}

                    </small>

                </div>

                @empty

                <div class="text-center py-5 text-muted">

                    No Recent Activity Found

                </div>

                @endforelse

            </div>

            <div class="card-footer bg-white text-right border-0">

                <a href="{{ url('/activity-logs') }}"
                    class="font-weight-bold">

                    View All Activity

                    <i class="fas fa-arrow-right ml-1"></i>

                </a>

            </div>

        </div>

    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-4 mb-4">

        <div class="card shadow-sm border-0" style="min-height:400px;">

            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

                <h5 class="mb-0 font-weight-bold">
                    Team Workload
                </h5>

                <!-- <select class="custom-select custom-select-sm" style="width:120px;">
                <option selected>This Month</option>
            </select> -->

            </div>

            <div class="card-body">

                @forelse($teamWorkload as $member)

                <div class="d-flex align-items-center mb-4">

                    <!-- Avatar -->
                    <div class="mr-3">

                        <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                            style="width:45px;height:45px;font-weight:bold;">

                            {{ strtoupper(substr($member['name'],0,1)) }}

                        </div>

                    </div>

                    <!-- Name & Role -->
                    <div class="flex-grow-1">

                        <div class="font-weight-bold">
                            {{ $member['name'] }}
                        </div>

                        <small class="text-muted">
                            {{ $member['role'] }}
                            ({{ $member['projects'] }} Projects)
                        </small>

                        <div class="progress mt-2"
                            style="height:7px;border-radius:20px;">

                            <div class="progress-bar bg-primary"
                                style="width:{{ $member['workload'] }}%;">
                            </div>

                        </div>

                    </div>

                    <!-- Percentage -->
                    <div class="ml-3">

                        @if($member['workload'] >= 80)

                        <span class="badge badge-danger">
                            {{ $member['workload'] }}%
                        </span>

                        @elseif($member['workload'] >= 50)

                        <span class="badge badge-warning">
                            {{ $member['workload'] }}%
                        </span>

                        @else

                        <span class="badge badge-success">
                            {{ $member['workload'] }}%
                        </span>

                        @endif

                    </div>

                </div>

                @empty

                <div class="text-center py-5 text-muted">

                    No Team Members Found

                </div>

                @endforelse

            </div>

            <!-- <div class="card-footer bg-white border-0 text-right">

            <a href="{{ url('/projects/team') }}"
                class="font-weight-bold">

                View Full Report

                <i class="fas fa-arrow-right ml-1"></i>

            </a>

        </div> -->

        </div>

    </div>
    <div class="col-lg-4 mb-4">

        <div class="card shadow-sm border-0" style="min-height:400px;">

            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

                <h5 class="mb-0 font-weight-bold">
                    Upcoming Deadlines
                </h5>

            </div>

            <div class="card-body">

                @forelse($upcomingDeadlines as $project)

                @php
                $days = \Carbon\Carbon::now()->diffInDays($project->deadline, false);

                if($days <= 3){
                    $badge='danger' ;
                    $text='High' ;
                    }
                    elseif($days <=7){
                    $badge='warning' ;
                    $text='Medium' ;
                    }
                    else{
                    $badge='success' ;
                    $text='Low' ;
                    }
                    @endphp

                    <div class="d-flex align-items-center mb-4">

                    <div class="text-center mr-3"
                        style="width:55px;">

                        <div class="font-weight-bold h5 mb-0">

                            {{ \Carbon\Carbon::parse($project->deadline)->format('d') }}

                        </div>

                        <small class="text-muted">

                            {{ strtoupper(\Carbon\Carbon::parse($project->deadline)->format('M')) }}

                        </small>

                    </div>

                    <div class="flex-grow-1">

                        <div class="font-weight-bold">

                            {{ $project->title }}

                        </div>

                        <small class="text-muted">

                            Deadline :
                            {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}

                        </small>

                    </div>

                    <!-- <span class="badge badge-{{ $badge }}">

                        {{ $text }}

                    </span> -->

            </div>

            @empty

            <div class="text-center text-muted py-5">

                No Upcoming Deadlines

            </div>

            @endforelse

        </div>

                <div class="card-footer bg-white border-0 text-right">

            <a href="{{ url('/admin/project-monitoring') }}"
                class="font-weight-bold">

                View Calendar

                <i class="fas fa-arrow-right ml-1"></i>

            </a>

        </div>

    </div> <!-- Upcoming Card -->

</div> <!-- Upcoming Column -->

<!-- Project Status Column Starts Here -->

<div class="col-lg-4 mb-4">

    <div class="card shadow-sm border-0" style="min-height:400px;">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

            <h5 class="mb-0 font-weight-bold">
                Project Status
            </h5>

        </div>

        <div class="card-body">

            @forelse($projectStatus as $project)

                <div class="mb-4">

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <div class="font-weight-bold">
                            {{ $project->title }}
                        </div>

                        <span class="font-weight-bold text-primary">
                            {{ $project->progress }}%
                        </span>

                    </div>

                    <div class="progress" style="height:8px;border-radius:20px;">

                        <div class="progress-bar
                            @if($project->progress >= 80)
                                bg-success
                            @elseif($project->progress >= 40)
                                bg-warning
                            @else
                                bg-danger
                            @endif"
                            style="width:{{ $project->progress }}%;">
                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-5 text-muted">
                    No Projects Found
                </div>

            @endforelse

        </div>

        <div class="card-footer bg-white border-0 text-right">

            <a href="{{ url('/projects/progress') }}"
                class="font-weight-bold">

                View All

                <i class="fas fa-arrow-right ml-1"></i>

            </a>

        </div>

    </div>

</div>

</div> <!-- Row End -->

@stop

@section('css')
<style>
    .dashboard-card {
        text-decoration: none !important;
        color: inherit;
    }

    .dashboard-box {

        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .08);
        transition: .3s;

    }

    .dashboard-box:hover {

        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, .15);

    }

    .dashboard-icon {

        width: 65px;
        height: 65px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #fff;

    }

    .card-body {

        min-height: 105px;

    }

    .revenue-filter {
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid #dee2e6;
        box-shadow: none;
    }

    .revenue-filter:focus {
        box-shadow: none;
        border-color: #007bff;
    }

    #projectCenterText {

        width: 120px;

        display: flex;

        flex-direction: column;

        justify-content: center;

        align-items: center;

    }
</style>
@stop
@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');

    let revenueChart = new Chart(ctx, {

        type: 'line',

        data: {

            labels: @json($revenueLabels),

            datasets: [{

                label: 'Revenue',

                data: @json($revenueValues),

                borderColor: '#4F46E5',

                backgroundColor: 'rgba(79,70,229,0.10)',

                fill: true,

                borderWidth: 3,

                tension: 0.4,

                pointRadius: 5,

                pointHoverRadius: 7

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }

            },

            scales: {

                y: {
                    beginAtZero: true
                }

            }

        }

    });
    const projectCtx = document.getElementById('projectChart').getContext('2d');

    new Chart(projectCtx, {

        type: 'doughnut',

        data: {

            labels: [
                'Completed',
                'In Progress',
                'Pending'
            ],

           datasets: [{
    data: [
        {{ $completedProjects }},
        {{ $inProgressProjects }},
        {{ $pendingProjects }}
    ],

    backgroundColor: [
                    '#28a745',
                    '#ffc107',
                    '#dc3545'
                ],

                hoverBackgroundColor: [
                    '#28a745',
                    '#ffc107',
                    '#dc3545'
                ],

                borderWidth: 0,
                hoverOffset: 8
            }]

        },

        options: {

            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',

            plugins: {

                legend: {
                    display: false
                },

                tooltip: {
                    enabled: true
                }

            },

            animation: {

                animateRotate: true,
                animateScale: true

            }

        }

    });

    $('#taskFilter').on('change', function() {

        let filter = $(this).val();

        $.ajax({
            url: "{{ route('admin.dashboard.task.filter') }}",
            type: "GET",
            data: {
                filter: filter
            },
            success: function(res) {

                $('#totalTasks').text(res.total);

                $('#completedCount').text(res.completed);
                $('#completedPercentage').text(res.completed_percentage);

                $('#progressCount').text(res.in_progress);
                $('#progressPercentage').text(res.in_progress_percentage);

                $('#pendingCount').text(res.pending);
                $('#pendingPercentage').text(res.pending_percentage);

                $('#completedBar').css('width', res.completed_percentage + '%');
                $('#progressBar').css('width', res.in_progress_percentage + '%');
                $('#pendingBar').css('width', res.pending_percentage + '%');

            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });

    });
    $('#revenueFilter').on('change', function() {

        let filter = $(this).val();

        $.ajax({

            url: "{{ route('admin.dashboard.revenue.filter') }}",

            type: "GET",

            data: {
                filter: filter
            },

            success: function(res) {

                $('#revenueAmount').text(
                    '₹' + Number(res.revenue).toLocaleString('en-IN', {
                        minimumFractionDigits: 2
                    })
                );

                revenueChart.data.labels = res.labels;

                revenueChart.data.datasets[0].data = res.values;

                revenueChart.update();

            },

            error: function(xhr) {

                console.log(xhr.responseText);

            }

        });

    });
</script>

@stop
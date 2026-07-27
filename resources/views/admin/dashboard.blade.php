@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Admin Dashboard</h1>
@stop

@section('content')

<div class="row">

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $totalProjects }}</h3>
                <p>Total Projects</p>
            </div>
            <div class="icon">
                <i class="fas fa-project-diagram"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalClients }}</h3>
                <p>Total Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalFreelancers }}</h3>
                <p>Total Freelancers</p>
            </div>
            <div class="icon">
                <i class="fas fa-laptop-code"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalEmployees }}</h3>
                <p>Total Employees</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-cog"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $totalTasks }}</h3>
                <p>Total Tasks</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
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

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pendingProjects }}</h3>
                <p>Pending Projects</p>
            </div>
            <div class="icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
        </div>
    </div>

</div>

@stop
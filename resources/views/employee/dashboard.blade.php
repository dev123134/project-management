@extends('adminlte::page')

@section('title', 'Employee Dashboard')

@section('content_header')
    <h1>Employee Dashboard</h1>
@stop

@section('content')

<div class="row">

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <a href="/tasks/assigned">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $assignedTasks }}</h3>
                <p>Assigned Tasks</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
        </div>
        </a>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <a href="/tasks/assigned">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $completedTasks }}</h3>
                <p>Completed Tasks</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        </a>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <a href="/tasks/assigned">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pendingTasks }}</h3>
                <p>Pending Tasks</p>
            </div>
            <div class="icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
        </div>
        </a>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $assignedProjects }}</h3>
                <p>Assigned Projects</p>
            </div>
            <div class="icon">
                <i class="fas fa-project-diagram"></i>
            </div>
        </div>
    </div>

    <!-- <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $todayUpdates }}</h3>
                <p>Today's Updates</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div> -->

</div>

@stop
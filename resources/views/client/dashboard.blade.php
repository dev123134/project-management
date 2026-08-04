@extends('adminlte::page')

@section('title', 'Client Dashboard')

@section('content_header')
<h1>Client Dashboard</h1>
@stop

@section('content')

<div class="row">

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <a href="/projects">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $totalProjects }}</h3>
                    <p>Total Projects</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
<a href="/projects">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $completedProjects }}</h3>
                <p>Completed Projects</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
</a>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <a href="/projects">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $activeProjects }}</h3>
                    <p>Active Projects</p>
                </div>
                <div class="icon">
                    <i class="fas fa-spinner"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <a href="/projects">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $pendingProjects }}</h3>
                    <p>Pending Projects</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
        <a href="/projects">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>₹ {{ number_format($totalBudget) }}</h3>
                    <p>Total Budget</p>
                </div>
                <div class="icon">
                    <i class="fas fa-rupee-sign"></i>
                </div>
            </div>
        </a>
    </div>

</div>

@stop
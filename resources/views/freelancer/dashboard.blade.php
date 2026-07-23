@extends('adminlte::page')

@section('title', 'Freelancer Dashboard')

@section('content_header')
    <h1>Freelancer Dashboard</h1>
@stop

@section('content')

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>10</h3>
                <p>Total Tasks</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>5</h3>
                <p>Completed Tasks</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>3</h3>
                <p>Pending Tasks</p>
            </div>
        </div>
    </div>

</div>

@stop
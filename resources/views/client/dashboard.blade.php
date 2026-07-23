@extends('adminlte::page')

@section('title', 'Client Dashboard')

@section('content_header')
    <h1>Client Dashboard</h1>
@stop

@section('content')

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>0</h3>
                <p>Total Projects</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>0</h3>
                <p>Completed Projects</p>
            </div>
        </div>
    </div>

</div>

@stop
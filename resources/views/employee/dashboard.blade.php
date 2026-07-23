@extends('adminlte::page')

@section('title', 'Employee Dashboard')

@section('content_header')
    <h1>Employee Dashboard</h1>
@stop

@section('content')

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>0</h3>
                <p>Assigned Tasks</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>0</h3>
                <p>Completed Tasks</p>
            </div>
        </div>
    </div>

</div>

@stop
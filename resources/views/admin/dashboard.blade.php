@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
<h1>Admin Dashboard</h1>
@stop

@section('content')

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ \App\Models\User::count() }}</h3>
                <p>Total Users</p>
                <!-- <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Role:</strong> {{ auth()->user()->role }}</p> -->
            </div>

            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

</div>

@stop
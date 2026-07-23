@extends('adminlte::page')

@section('title', 'Project Team')

@section('content_header')
<h1>Add Team Member</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="/projects/team/store" method="POST">

    @csrf

    <input type="hidden" name="project_id" value="{{ $project->id }}">

    <div class="mb-3">
        <label>Select User</label>

        <select name="user_id" class="form-control">

            @foreach($users as $user)

                <option value="{{ $user->id }}">
                    {{ $user->name }} ({{ $user->role }})
                </option>

            @endforeach

        </select>
    </div>

    <button class="btn btn-success">
        Add Team Member
    </button>

</form>

@stop
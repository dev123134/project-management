@extends('adminlte::page')

@section('content')

<h2>Create Group</h2>

<form action="/groups/store" method="POST">

    @csrf

    <div class="mb-3">
        <label>Group Name</label>

        <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
        <label>Select Members</label>

        @foreach($users as $user)

            <div>
                <input type="checkbox"
                       name="members[]"
                       value="{{ $user->id }}">

                {{ $user->name }}
            </div>

        @endforeach

    </div>

    <button class="btn btn-success">
        Create Group
    </button>

</form>

@stop
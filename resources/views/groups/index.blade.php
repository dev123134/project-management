@extends('adminlte::page')

@section('content')

<h2>Groups</h2>

<a href="/groups/create" class="btn btn-success mb-3">
    Create Group
</a>

<table class="table table-bordered">

    <tr>
        <th>ID</th>
        <th>Group Name</th>
        <th>Actions</th>
    </tr>

    @foreach($groups as $group)

    <tr>
        <td>{{ $group->id }}</td>
        <td>{{ $group->name }}</td>
        <td>
    <a href="/groups/{{ $group->id }}/chat"
       class="btn btn-primary">
       Open Chat
    </a>
</td>
    </tr>

    @endforeach

</table>

@stop
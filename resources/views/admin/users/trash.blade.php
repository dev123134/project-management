@extends('adminlte::page')

@section('title', 'Trash Users')

@section('content_header')
<h1>Trash Users</h1>
@stop
@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>

</div>

@endif
@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show">

    {{ session('error') }}

    <button type="button" class="close" data-dismiss="alert">

        <span>&times;</span>

    </button>

</div>

@endif
@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">User List</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                <tr>

                    <td>{{ $user->id }}</td>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                    <td>{{ ucfirst($user->role) }}</td>
                    <td>{{ $user->deleted_at }}</td>
                    <td>


                        <form action="{{ route('admin.users.restore', $user->id) }}"
                            method="POST"
                            style="display:inline;">
                            @csrf
                            @method('PATCH')

                            <button class="btn btn-success btn-sm">
                                <i class="fas fa-undo"></i>
                            </button>
                        </form>
                       
                        <form action="{{ route('admin.users.forceDelete', $user->id) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('This action cannot be undone. Permanently delete this user?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>
                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@stop
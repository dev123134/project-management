@extends('adminlte::page')

@section('title', 'All Users')

@section('content_header')
<h1>All Users</h1>
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

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
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

                        <td>

                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            @if($user->status == 'active')

                            <form action="{{ route('admin.users.block', $user->id) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    class="btn btn-sm btn-dark"
                                    onclick="return confirm('Are you sure you want to block this user?')">
                                    <i class="fas fa-ban"></i>
                                </button>

                            </form>

                            @else

                            <form action="{{ route('admin.users.unblock', $user->id) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    class="btn btn-sm btn-success"
                                    onclick="return confirm('Are you sure you want to unblock this user?')">
                                    <i class="fas fa-check"></i>
                                </button>

                            </form>

                            @endif

                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to move this user to trash?')">
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

</div>

@stop
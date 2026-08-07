@extends('adminlte::page')

@section('title','User Wise Report')

@section('content')

<div class="container-fluid">

   <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

    <h2 class="mb-2 mb-md-0">

        <i class="fas fa-users"></i>

        User Wise Report

    </h2>

    <div class="d-flex flex-wrap gap-2">

        <a href="{{ route('admin.reports.user-wise.pdf') }}"
           class="btn btn-danger">

            <i class="fas fa-file-pdf"></i>

            PDF Export

        </a>

        <a href="{{ route('admin.reports.user-wise.csv') }}"
           class="btn btn-success">

            <i class="fas fa-file-excel"></i>

            CSV Export

        </a>

        <!-- <a href="{{ url()->previous() }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Back

        </a> -->

    </div>

</div>

    <div class="row">

        <div class="col-md-3">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>{{ $totalUsers }}</h3>

                    <p>Total Users</p>

                </div>

                <div class="icon">

                    <i class="fas fa-users"></i>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>{{ $freelancers }}</h3>

                    <p>Freelancers</p>

                </div>

                <div class="icon">

                    <i class="fas fa-user-tie"></i>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="small-box bg-warning">

                <div class="inner">

                    <h3>{{ $employees }}</h3>

                    <p>Employees</p>

                </div>

                <div class="icon">

                    <i class="fas fa-user"></i>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="small-box bg-danger">

                <div class="inner">

                    <h3>{{ $clients }}</h3>

                    <p>Clients</p>

                </div>

                <div class="icon">

                    <i class="fas fa-user-friends"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="card card-primary">

        <div class="card-header">

            <h3 class="card-title">

                Search & Filter

            </h3>

        </div>

        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-5">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search Name / Email"
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-4">

                        <select
                            name="role"
                            class="form-control">

                            <option value="">All Roles</option>

                            <option value="freelancer"
                                {{ request('role')=='freelancer'?'selected':'' }}>
                                Freelancer
                            </option>

                            <option value="employee"
                                {{ request('role')=='employee'?'selected':'' }}>
                                Employee
                            </option>

                            <option value="client"
                                {{ request('role')=='client'?'selected':'' }}>
                                Client
                            </option>

                        </select>

                    </div>

                    <div class="col-md-3">

                        <button
                            class="btn btn-primary">

                            Search

                        </button>

                        <a href="{{ route('admin.reports.user-wise') }}"
                           class="btn btn-secondary">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                Users List

            </h3>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Role</th>

                        <th>Projects</th>

                        <th>Daily Updates</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>
                                        @forelse($users as $user)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>

                                @if($user->role == 'admin')

                                    <span class="badge badge-danger">
                                        Admin
                                    </span>

                                @elseif($user->role == 'freelancer')

                                    <span class="badge badge-success">
                                        Freelancer
                                    </span>

                                @elseif($user->role == 'employee')

                                    <span class="badge badge-primary">
                                        Employee
                                    </span>

                                @else

                                    <span class="badge badge-warning">
                                        Client
                                    </span>

                                @endif

                            </td>

                            <td>

                                {{
                                    \App\Models\ProjectMember::where(
                                        'user_id',
                                        $user->id
                                    )->count()
                                }}

                            </td>

                            <td>

                                {{
                                    \App\Models\DailyUpdate::where(
                                        'user_id',
                                        $user->id
                                    )->count()
                                }}

                            </td>

                            <td>

                                <a href="{{ route('admin.reports.user-details',$user->id) }}"
                                   class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                    View

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center text-danger">

                                No Users Found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer clearfix">

            {{ $users->links('pagination::bootstrap-4') }}

        </div>

    </div>

</div>

@endsection
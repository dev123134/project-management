@extends('adminlte::page')

@section('title', 'Login History')

@section('content_header')
<div class="d-flex justify-content-between align-items-center flex-wrap">
    <h1 class="mb-2 mb-md-0">Login History</h1>
</div>
@stop

@section('content')

<!-- Dashboard Cards -->
<div class="row">

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-primary shadow-sm">
            <div class="inner">
                <h3>{{ $totalLogins }}</h3>
                <p>Total Logins</p>
            </div>
            <div class="icon">
                <i class="fas fa-sign-in-alt"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-success shadow-sm">
            <div class="inner">
                <h3>{{ $onlineUsers }}</h3>
                <p>Online Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-check"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-warning shadow-sm">
            <div class="inner">
                <h3>{{ $todayLogins }}</h3>
                <p>Today's Logins</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-day"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
        <div class="small-box bg-danger shadow-sm">
            <div class="inner">
                <h3>{{ $totalAdmins }}</h3>
                <p>Admin Logins</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>

</div>

<!-- Search Card -->
<div class="card shadow-sm">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-search mr-1"></i>
            Search Login History
        </h3>
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('admin.login-history') }}">

            <div class="row">

                <div class="col-lg-4 col-md-6 col-12 mb-3">

                    <label>User</label>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by user name..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-3">

                    <label>Role</label>

                    <select name="role" class="form-control">

                        <option value="">All Roles</option>

                        <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="client" {{ request('role')=='client' ? 'selected' : '' }}>
                            Client
                        </option>

                        <option value="freelancer" {{ request('role')=='freelancer' ? 'selected' : '' }}>
                            Freelancer
                        </option>

                        <option value="employee" {{ request('role')=='employee' ? 'selected' : '' }}>
                            Employee
                        </option>

                    </select>

                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-3">

                    <label>Login Date</label>

                    <input
                        type="date"
                        name="date"
                        class="form-control"
                        value="{{ request('date') }}">

                </div>

                <div class="col-lg-2 col-md-6 col-12 mb-3 d-flex align-items-end">

                    <button type="submit" class="btn btn-primary w-100 mr-2">

                        <i class="fas fa-search"></i>

                        Search

                    </button>

                    <a href="{{ route('admin.login-history') }}"
                       class="btn btn-secondary w-100">

                        <i class="fas fa-redo"></i>

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover table-striped">

            <thead class="thead-dark">

                <tr>

                    <th>#</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>IP Address</th>
                    <th>Browser</th>
                    <th>Operating System</th>
                    <th>Login Date</th>
                    <th>Logout Date</th>
                    <th>Session Time</th>
                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                @forelse($loginHistories as $history)

<tr class="{{ $loop->first ? 'table-success' : '' }}">

    <td class="text-center align-middle">
        {{ $loginHistories->firstItem() + $loop->index }}
    </td>

    <td class="align-middle">

        <div class="font-weight-bold">
            {{ $history->user->name ?? 'N/A' }}
        </div>

        <small class="text-muted">
            {{ $history->user->email ?? '' }}
        </small>

    </td>

    <td class="text-center align-middle">

        @switch($history->user->role)

            @case('admin')
                <span class="badge badge-danger">Admin</span>
                @break

            @case('client')
                <span class="badge badge-primary">Client</span>
                @break

            @case('freelancer')
                <span class="badge badge-warning">Freelancer</span>
                @break

            @case('employee')
                <span class="badge badge-success">Employee</span>
                @break

            @default
                <span class="badge badge-secondary">
                    {{ ucfirst($history->user->role ?? '-') }}
                </span>

        @endswitch

    </td>

    <td class="align-middle">
        <i class="fas fa-network-wired text-primary mr-1"></i>
        {{ $history->ip_address }}
    </td>

    <td class="align-middle">
        <i class="fab fa-chrome text-info mr-1"></i>
        {{ $history->browser }}
    </td>

    <td class="align-middle">
        <i class="fas fa-desktop text-secondary mr-1"></i>
        {{ $history->os }}
    </td>

    <td class="align-middle">

        <strong>
            {{ $history->login_at->format('d M Y') }}
        </strong>

        <br>

        <small class="text-muted">
            {{ $history->login_at->format('h:i A') }}
        </small>

    </td>

    <td class="align-middle">

        @if($history->logout_at)

            <strong>
                {{ $history->logout_at->format('d M Y') }}
            </strong>

            <br>

            <small class="text-muted">
                {{ $history->logout_at->format('h:i A') }}
            </small>

        @else

            <span class="badge badge-success">
                Active Session
            </span>

        @endif

    </td>

    <td class="text-center align-middle">

        @if($history->logout_at)

            <span class="badge badge-info">
                {{ $history->login_at->diffForHumans($history->logout_at, true) }}
            </span>

        @else

            <span class="badge badge-warning">
                Running...
            </span>

        @endif

    </td>

    <td class="text-center align-middle">

        @if($history->logout_at)

            <span class="badge badge-danger">
                <i class="fas fa-times-circle"></i>
                Offline
            </span>

        @else

            <span class="badge badge-success">
                <i class="fas fa-check-circle"></i>
                Online
            </span>

        @endif

    </td>

</tr>

@empty

<tr>

    <td colspan="10" class="text-center py-5">

        <i class="fas fa-history fa-3x text-muted mb-3"></i>

        <br>

        <strong>No Login History Found</strong>

    </td>

</tr>

@endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer clearfix">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div class="mb-2">

                <small class="text-muted">

                    Showing

                    <strong>{{ $loginHistories->firstItem() ?? 0 }}</strong>

                    to

                    <strong>{{ $loginHistories->lastItem() ?? 0 }}</strong>

                    of

                    <strong>{{ $loginHistories->total() }}</strong>

                    records

                </small>

            </div>

            <div class="ml-auto">

                {{ $loginHistories->withQueryString()->links() }}

            </div>

        </div>

    </div>

</div>

@stop

@section('css')

<style>

.small-box{
    border-radius:10px;
}

.small-box .inner h3{
    font-weight:700;
}

.table th{
    white-space: nowrap;
    text-align:center;
    vertical-align: middle;
}

.table td{
    vertical-align: middle;
}

.badge{
    font-size:13px;
    padding:7px 10px;
}

.card{
    border-radius:10px;
}

.card-header{
    background:#fff;
}

.pagination{
    justify-content:end;
    margin-bottom:0;
}

@media (max-width:768px){

    .pagination{
        justify-content:center;
    }

    .small-box{
        margin-bottom:15px;
    }

    .table{
        min-width:1100px;
    }

}

</style>

@stop
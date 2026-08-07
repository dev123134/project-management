@extends('adminlte::page')

@section('title','Group Chat Report')

@section('content')

<div class="container-fluid">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

        <h2 class="mb-2 mb-md-0">

            <i class="fas fa-users"></i>

            Group Chat Report

        </h2>

        <div class="d-flex flex-wrap gap-2">

            <a href="{{ route('admin.reports.group-chat.pdf') }}"
                class="btn btn-danger">

                <i class="fas fa-file-pdf"></i>

                PDF Export

            </a>

            <a href="{{ route('admin.reports.group-chat.csv') }}"
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

        <div class="col-md-6">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>{{ $totalMessages }}</h3>

                    <p>Total Group Messages</p>

                </div>

                <div class="icon">

                    <i class="fas fa-comments"></i>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="small-box bg-info">

                <div class="inner">

                    <h3>{{ $todayMessages }}</h3>

                    <p>Today's Messages</p>

                </div>

                <div class="icon">

                    <i class="fas fa-calendar-day"></i>

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

                    <div class="col-md-3">

                        <input type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search Message"
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-3">

                        <select name="user" class="form-control">

                            <option value="">All Users</option>

                            @foreach($users as $user)

                            <option value="{{ $user->id }}"
                                {{ request('user') == $user->id ? 'selected' : '' }}>

                                {{ $user->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-3">

                        <select name="group" class="form-control">

                            <option value="">All Groups</option>

                            @foreach($groups as $group)

                            <option value="{{ $group->id }}"
                                {{ request('group') == $group->id ? 'selected' : '' }}>

                                {{ $group->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-2">

                        <input type="date"
                            name="date"
                            class="form-control"
                            value="{{ request('date') }}">

                    </div>

                    <div class="col-md-1">

                        <button class="btn btn-primary">

                            <i class="fas fa-search"></i>

                        </button>

                    </div>

                </div>

                <div class="mt-3">

                    <a href="{{ route('admin.reports.group-chat-report') }}"
                        class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </form>

        </div>

    </div>
    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                Group Chat Messages

            </h3>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>User</th>
                        <th>Group</th>
                        <th>Message</th>
                        <th>Attachment</th>
                        <th>Date & Time</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($groupMessages as $message)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            {{ optional($message->user)->name }}

                        </td>

                        <td>

                            {{ optional($message->group)->name }}

                        </td>

                        <td>

                            {{ \Illuminate\Support\Str::limit($message->message,50) }}

                        </td>

                        <td>

                            @if($message->file)

                            <span class="badge badge-success">

                                Yes

                            </span>

                            @else

                            <span class="badge badge-secondary">

                                No

                            </span>

                            @endif

                        </td>

                        <td>

                            {{ $message->created_at->format('d M Y h:i A') }}

                        </td>

                        <td>

                            <a href="{{ route('admin.reports.group-chat-details',$message->id) }}"
                                class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                                View

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7"
                            class="text-center text-danger">

                            No Group Messages Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer">

            {{ $groupMessages->links('pagination::bootstrap-4') }}

        </div>

    </div>

</div>

@endsection
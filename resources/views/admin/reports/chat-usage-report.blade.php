@extends('adminlte::page')

@section('title','Chat Usage Report')

@section('content')

<div class="container-fluid">

   <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

    <h2 class="mb-2 mb-md-0">

        <i class="fas fa-comments"></i>

        Chat Usage Report

    </h2>

    <div class="d-flex flex-wrap gap-2">

        <a href="{{ route('admin.reports.chat-usage.pdf') }}"
           class="btn btn-danger">

            <i class="fas fa-file-pdf"></i>

            PDF Export

        </a>

        <a href="{{ route('admin.reports.chat-usage.csv') }}"
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

                    <h3>{{ $totalMessages }}</h3>

                    <p>Total Messages</p>

                </div>

                <div class="icon">

                    <i class="fas fa-comments"></i>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="small-box bg-info">

                <div class="inner">

                    <h3>{{ $privateCount }}</h3>

                    <p>Private Chats</p>

                </div>

                <div class="icon">

                    <i class="fas fa-user-friends"></i>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>{{ $groupCount }}</h3>

                    <p>Group Chats</p>

                </div>

                <div class="icon">

                    <i class="fas fa-users"></i>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="small-box bg-warning">

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

                    <div class="col-md-4">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search Message"
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-3">

                        <select
                            name="sender"
                            class="form-control">

                            <option value="">All Senders</option>

                            @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ request('sender')==$user->id?'selected':'' }}>

                                {{ $user->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-3">

                        <select
                            name="receiver"
                            class="form-control">

                            <option value="">All Receivers</option>

                            @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ request('receiver')==$user->id?'selected':'' }}>

                                {{ $user->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary">

                            Search

                        </button>

                        <a
                            href="{{ route('admin.reports.chat-usage-report') }}"
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

            Private Chat Messages

        </h3>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Sender</th>

                    <th>Receiver</th>

                    <th>Message</th>

                    <th>Attachment</th>

                    <th>Date & Time</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

@forelse($privateMessages as $message)                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

{{ optional($message->sender)->name }}                        </td>

                        <td>

{{ optional($message->receiver)->name }}                        </td>

                        <td>

{{ Str::limit($message->message,50) }}
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

                            <a
                                href="{{ route('admin.reports.chat-details',$message->id) }}"
                                class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                                View

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center text-danger">

                            No Chat Messages Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $privateMessages->links('pagination::bootstrap-4') }}

    </div>

</div>

</div>

@endsection
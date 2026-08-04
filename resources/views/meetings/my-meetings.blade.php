@extends('adminlte::page')

@section('title', 'My Meetings')

@section('content_header')
<h1>My Meetings</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button type="button"
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>
@endif
<!-- <div class="mb-3 text-end">

    @if(Auth::user()->role == 'employee')
    <a href="{{ route('employee.meetings.create') }}" class="btn btn-success">
        @elseif(Auth::user()->role == 'client')
        <a href="{{ route('client.meetings.create') }}" class="btn btn-success">
            @elseif(Auth::user()->role == 'freelancer')
            <a href="{{ route('freelancer.meetings.create') }}" class="btn btn-success">
                @else
                <a href="{{ route('admin.meetings.create') }}" class="btn btn-success">
                    @endif

                    <i class="fas fa-plus"></i> Schedule Meeting

                </a>

                <i class="fas fa-plus"></i>

                Schedule Meeting

            </a>

</div> -->
<div class="card">

    <div class="card-header bg-primary">

        <h3 class="card-title">

            <i class="fas fa-video"></i>

            My Meetings

        </h3>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-light">

                    <tr>

                        <th>ID</th>

                        <th>Meeting Title</th>

                        <th>Date</th>

                        <th>Time</th>

                        <th>Duration</th>

                        <th>Created By</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($meetings as $meeting)

                    <tr>

                        <td>{{ $meeting->id }}</td>

                        <td>{{ $meeting->meeting_title }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d-m-Y') }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('h:i A') }}
                        </td>

                        <td>
                            {{ $meeting->duration }} Minutes
                        </td>

                        <td>
                            {{ $meeting->creator->name }}
                        </td>

                        <td>

                            @if($meeting->status=='upcoming')

                            <span class="badge bg-primary">

                                Upcoming

                            </span>

                            @elseif($meeting->status=='completed')

                            <span class="badge bg-success">

                                Completed

                            </span>

                            @else

                            <span class="badge bg-danger">

                                Cancelled

                            </span>

                            @endif

                        </td>

                        <td>

                            @if($meeting->meeting_link)

                            <a href="{{ $meeting->meeting_link }}"
                                target="_blank"
                                class="btn btn-success btn-sm">

                                <i class="fas fa-video"></i>

                                Join Meeting

                            </a>

                            @else

                            <button class="btn btn-secondary btn-sm"
                                disabled>

                                Link Not Available

                            </button>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8"
                            class="text-center text-muted">

                            No Meetings Available.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if($meetings->count())

    <div class="card-footer">

        {{ $meetings->links() }}

    </div>

    @endif

</div>

@stop
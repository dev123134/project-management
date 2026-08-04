@extends('adminlte::page')

@section('title', 'Meetings')

@section('content_header')
<h1>Meeting Management</h1>
@stop

@section('content')
@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <!-- <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button> -->

</div>

@endif
@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show">

    {{ session('error') }}


</div>

@endif
<!-- <div class="mb-3 text-end">
    <a href="{{ route('admin.meetings.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Schedule Meeting
    </a>
</div> -->

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
                <th width="260">Action</th>
            </tr>

        </thead>

        <tbody>

            @forelse($meetings as $meeting)

            <tr>

                <td>{{ $meeting->id }}</td>

                <td>{{ $meeting->meeting_title }}</td>

                <td>{{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d-m-Y') }}</td>

                <td>{{ \Carbon\Carbon::parse($meeting->meeting_time)->format('h:i A') }}</td>

                <td>{{ $meeting->duration }} Min</td>

                <td>{{ $meeting->creator->name ?? '-' }}</td>

                <td>

                    @if($meeting->status == 'upcoming')

                    <span class="badge bg-primary">
                        Upcoming
                    </span>

                    @elseif($meeting->status == 'completed')

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

                    <a href="{{ route('admin.meetings.show',$meeting->id) }}"
                        class="btn btn-info btn-sm">
                        View
                    </a>

                    <a href="{{ route('admin.meetings.edit',$meeting->id) }}"
                        class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('admin.meetings.destroy',$meeting->id) }}"
                        method="POST"
                        class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="8" class="text-center text-muted">
                    No Meetings Found.
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@if($meetings->count())

<div class="mt-3">
    {{ $meetings->links() }}
</div>

@endif

@stop
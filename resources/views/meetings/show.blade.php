@extends('adminlte::page')

@section('title', 'Meeting Details')

@section('content_header')
<h1>Meeting Details</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header bg-primary">
        <h3 class="card-title">
            {{ $meeting->meeting_title }}
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="220">Meeting Title</th>
                <td>{{ $meeting->meeting_title }}</td>
            </tr>

            <tr>
                <th>Description</th>
                <td>{{ $meeting->meeting_description ?? '-' }}</td>
            </tr>

            <tr>
                <th>Date</th>
                <td>{{ $meeting->meeting_date }}</td>
            </tr>

            <tr>
                <th>Time</th>
                <td>{{ date('h:i A', strtotime($meeting->meeting_time)) }}</td>
            </tr>

            <tr>
                <th>Duration</th>
                <td>{{ $meeting->duration }} Minutes</td>
            </tr>

            <tr>
                <th>Google Meet Link</th>

                <td>

                    @if($meeting->meeting_link)

                        <a href="{{ $meeting->meeting_link }}"
                           target="_blank"
                           class="btn btn-success btn-sm">

                            Join Meeting

                        </a>

                    @else

                        <span class="text-danger">

                            Not Added Yet

                        </span>

                    @endif

                </td>

            </tr>

            <tr>

                <th>Created By</th>

                <td>{{ $meeting->creator->name }}</td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    <span class="badge bg-primary">

                        {{ ucfirst($meeting->status) }}

                    </span>

                </td>

            </tr>

            <tr>

                <th>Participants</th>

                <td>

                    <ul class="mb-0">

                        @foreach($meeting->participants as $participant)

                            <li>

                                {{ $participant->user->name }}

                                ({{ ucfirst($participant->user->role) }})

                            </li>

                        @endforeach

                    </ul>

                </td>

            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a href="{{ route('admin.meetings.index') }}"
           class="btn btn-secondary">

            Back

        </a>

    </div>

</div>

@stop
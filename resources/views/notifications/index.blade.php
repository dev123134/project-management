

@extends('adminlte::page')

@section('content')

<h2>Notifications</h2>

<table class="table table-bordered">

    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

    @foreach($notifications as $notification)

    <tr>

        <td>{{ $notification->id }}</td>

        <td>{{ $notification->title }}</td>

        <td>
            @if($notification->is_read)
            Read
            @else
            Unread
            @endif
        </td>

        <td>
            {{ $notification->created_at->format('d-m-Y') }}
        </td>
        <td>
            @if(!$notification->is_read)

            <a href="/notifications/read/{{ $notification->id }}"
                class="btn btn-success btn-sm">

                Mark Read

            </a>

            @else

            <span class="badge bg-success">
                Read
            </span>

            @endif
        </td>
    </tr>

    @endforeach

</table>

@stop
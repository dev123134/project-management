@extends('adminlte::page')

@section('title', 'Notifications')

@section('content')

<div class="container-fluid">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                class="close"
                data-dismiss="alert">

                <span>&times;</span>

            </button>

        </div>
    @endif

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="card-title">
                Notifications
            </h3>

            <form action="{{ route('notifications.markAllRead') }}"
                method="POST">

                @csrf

                <button class="btn btn-primary btn-sm ">

                    <i class="fas fa-check-double"></i>

                    Mark All Read

                </button>

            </form>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Title</th>

                            <th>Message</th>

                            <th>Type</th>

                            <th>Status</th>

                            <th>Date</th>

                            <th width="170">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($notifications as $notification)

                        <tr>

                            <td>
                                {{ $notification->id }}
                            </td>

                            <td>

                                @if($notification->icon)

                                    <i class="{{ $notification->icon }} text-{{ $notification->color }}"></i>

                                @endif

                                {{ $notification->title }}

                            </td>

                            <td>

                                {{ $notification->message }}

                            </td>

                            <td>

                                <span class="badge badge-info">

                                    {{ ucfirst($notification->type) }}

                                </span>

                            </td>

                            <td>

                                @if($notification->is_read)

                                    <span class="badge badge-success">

                                        Read

                                    </span>

                                @else

                                    <span class="badge badge-warning">

                                        Unread

                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $notification->created_at->format('d M Y h:i A') }}

                            </td>

                            <td>

                                @if(!$notification->is_read)

                                    <a href="{{ route('notifications.read',$notification->id) }}"
                                        class="btn btn-success btn-sm">

                                        <i class="fas fa-check"></i>

                                        Read

                                    </a>

                                @endif


                                <form
                                    action="{{ route('notifications.destroy',$notification->id) }}"
                                    method="POST"
                                    style="display:inline;">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this notification?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center">

                                No Notifications Found

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        @if(method_exists($notifications,'links'))

        <div class="card-footer">

            {{ $notifications->links() }}

        </div>

        @endif

    </div>

</div>

@stop
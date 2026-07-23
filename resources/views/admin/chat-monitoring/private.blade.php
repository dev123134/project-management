@extends('adminlte::page')

@section('title', 'Private Chats')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Private Chat Monitoring
        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Sender</th>

                    <th>Receiver</th>

                    <th>Message</th>

                    <th>File</th>

                    <th>Date</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($messages as $message)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ optional($message->sender)->name ?? 'Deleted User' }}</td>
                    <td>{{ optional($message->receiver)->name ?? 'Deleted User' }}</td>

                    <td>{{ $message->message }}</td>

                    <td>

                        @if($message->file)

                        <a href="{{ asset('uploads/'.$message->file) }}"
                            target="_blank">

                            Download

                        </a>

                        @else

                        -

                        @endif

                    </td>

                    <td>{{ $message->created_at->format('d M Y h:i A') }}</td>

                    <td>

                        <a href="{{ route('admin.chat.view', [$message->sender_id, $message->receiver_id]) }}"
                            class="btn btn-info btn-sm">

                            <i class="fas fa-eye"></i>

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="text-center">

                        No Chats Found

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
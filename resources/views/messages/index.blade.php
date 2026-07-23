@extends('adminlte::page')

@section('content')

<h2>Messages</h2>

<a href="/messages/create"
   class="btn btn-success mb-3">
    Send Message
</a>

<table class="table table-bordered">

    <tr>
        <th>Sender</th>
        <th>Receiver</th>
        <th>Message</th>
        <th>Action</th>
    </tr>

    @foreach($messages as $message)

    <tr>

        <td>
            {{ optional($message->sender)->name }}
            ({{ optional($message->sender)->role ? ucfirst($message->sender->role) : 'N/A' }})
        </td>

        <td>
            {{ optional($message->receiver)->name }}
            ({{ optional($message->receiver)->role ? ucfirst($message->receiver->role) : 'N/A' }})
        </td>

        <td>{{ $message->message }}</td>

        <td>

            @if($message->sender_id == Auth::id())

                <a href="/chat/{{ $message->receiver_id }}"
                   class="btn btn-primary btn-sm">
                    Chat
                </a>

            @else

                <a href="/chat/{{ $message->sender_id }}"
                   class="btn btn-primary btn-sm">
                    Chat
                </a>

            @endif

        </td>

    </tr>

    @endforeach

</table>

@stop
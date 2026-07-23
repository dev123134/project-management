<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Group;
use App\Models\GroupMessage;


class ChatMonitoringController extends Controller
{


public function privateChats()
{
    $messages = Message::with(['sender', 'receiver'])
        ->latest()
        ->get();

    return view(
        'admin.chat-monitoring.private',
        compact('messages')
    );
}

public function groupChats()
{
    $groups = Group::withCount(['messages', 'members'])
        ->latest()
        ->get();

    return view(
        'admin.chat-monitoring.groups',
        compact('groups')
    );
}

public function viewConversation($senderId, $receiverId)
{
    $sender = User::findOrFail($senderId);

    $receiver = User::findOrFail($receiverId);

    $messages = Message::where(function ($query) use ($senderId, $receiverId) {

        $query->where('sender_id', $senderId)
              ->where('receiver_id', $receiverId);

    })->orWhere(function ($query) use ($senderId, $receiverId) {

        $query->where('sender_id', $receiverId)
              ->where('receiver_id', $senderId);

    })
    ->orderBy('created_at', 'asc')
    ->get();

    return view(
        'admin.chat-monitoring.view',
        compact('sender', 'receiver', 'messages')
    );
}

public function viewGroupConversation(Group $group)
{
    $messages = GroupMessage::with('user')
        ->where('group_id', $group->id)
        ->orderBy('created_at', 'asc')
        ->get();

    return view(
        'admin.chat-monitoring.group-view',
        compact('group', 'messages')
    );
}
}

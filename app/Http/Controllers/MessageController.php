<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Notification;

class MessageController extends Controller
{
    public function index()
{
    $authId = Auth::id();

    $users = User::where('id', '!=', $authId)
        ->where('status', 'active')
        ->get();

    $users = $users->map(function ($user) use ($authId) {

        $lastMessage = Message::where(function ($query) use ($authId, $user) {

            $query->where('sender_id', $authId)
                  ->where('receiver_id', $user->id);

        })->orWhere(function ($query) use ($authId, $user) {

            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $authId);

        })->latest()->first();

        $user->last_message = $lastMessage;

        $user->has_unread = Message::where('sender_id', $user->id)
            ->where('receiver_id', $authId)
            ->where('is_read', false)
            ->exists();

        return $user;

    })->sortByDesc(function ($user) {

        return optional($user->last_message)->created_at;

    });

    return view('messages.index', compact('users'));
}

    public function create()
    {

        $users = User::where('id', '!=', Auth::id())->get();
        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
        ]);

        $fileName = null;

        if ($request->hasFile('file')) {

            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();

            $request->file('file')
                ->move(public_path('uploads'), $fileName);
        }
        if ($request->receiver_id == Auth::id()) {
            abort(403);
        }
        Notification::create([

            'user_id' => $request->receiver_id,

            'title' => 'New Message',

            'message' => Auth::user()->name . ' sent you a new message.',

            'type' => 'chat',

            'icon' => 'fas fa-comments',

            'color' => 'info',

            'url' => '/messages',

            'is_read' => false,

        ]);
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'file' => $fileName,
            'is_read' => false,
        ]);

        return redirect('/messages')
            ->with('success', 'Message Sent Successfully');
    }

    public function chat($id)
    {
        $user = User::findOrFail($id);

        if ($id == Auth::id()) {
            abort(403);
        }

        // Mark received messages as read
        Message::where('sender_id', $id)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true
            ]);

        $messages = Message::where(function ($query) use ($id) {

            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {

            $query->where('sender_id', $id)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();

        return view('messages.chat', compact('user', 'messages'));
    }
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
        ]);
        $fileName = null;

        if ($request->hasFile('file')) {

            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();

            $request->file('file')
                ->move(public_path('uploads'), $fileName);
        }

        Message::create([

            'sender_id' => Auth::id(),

            'receiver_id' => $request->receiver_id,

            'message' => $request->message,

            'file' => $fileName,

            'is_read' => false,

        ]);
        if ($request->receiver_id == Auth::id()) {
            abort(403);
        }
        Notification::create([

            'user_id' => $request->receiver_id,

            'title' => 'New Message',

            'message' => Auth::user()->name . ' sent you a new message.',

            'type' => 'chat',

            'icon' => 'fas fa-comments',

            'color' => 'info',

            'url' => '/messages',

            'is_read' => false,

        ]);

        return back();
    }
}

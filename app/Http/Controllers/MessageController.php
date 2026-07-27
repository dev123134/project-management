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
        $messages = Message::with(['sender', 'receiver'])
            ->where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->latest()
            ->get();

        return view('messages.index', compact('messages'));
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

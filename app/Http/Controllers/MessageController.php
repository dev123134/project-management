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
        $fileName = null;

        if ($request->hasFile('file')) {

            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();

            $request->file('file')
                ->move(public_path('uploads'), $fileName);
        }
        Notification::create([

            'user_id' => $request->receiver_id,
            'title'   => 'You received a new message',
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

        Notification::create([

            'user_id' => $request->receiver_id,

            'title' => 'You received a new message',

        ]);

        return back();
    }
}

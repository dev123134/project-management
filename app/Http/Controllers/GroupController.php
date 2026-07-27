<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\GroupMember;
use App\Models\GroupMessage;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::whereHas('members', function ($q) {
            $q->where('user_id', Auth::id());
        })->get();

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $users = User::whereIn('role', ['employee', 'freelancer'])->get();

        return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $group = Group::create([
            'name' => $request->name,
        ]);
GroupMember::create([
    'group_id' => $group->id,
    'user_id'  => Auth::id(),
]);
        foreach ($request->members ?? [] as $userId) {
            GroupMember::create([
                'group_id' => $group->id,
                'user_id' => $userId,
            ]);
        }

        return redirect('/groups')
            ->with('success', 'Group Created Successfully');
    }
    public function chat($id)
    {
        $group = Group::findOrFail($id);

        if (!$group->members()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        $messages = GroupMessage::where('group_id', $id)
            ->with('user')
            ->get();

        return view(
            'groups.chat',
            compact('group', 'messages')
        );
    }
    public function sendMessage(Request $request, $id)
    {
        $group = Group::findOrFail($id);

        if (!$group->members()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        $request->validate([
            'message' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
        ]);

        $fileName = null;

        if ($request->hasFile('file')) {
            $fileName =
                time() . '_' .
                $request->file('file')
                ->getClientOriginalName();

            $request->file('file')
                ->move(
                    public_path('uploads'),
                    $fileName
                );
        }

        GroupMessage::create([

            'group_id' => $id,

            'user_id' => Auth::id(),

            'message' => $request->message,

            'file' => $fileName,

        ]);

        return back();
    }
}

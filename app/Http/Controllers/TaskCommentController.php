<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskCommentController extends Controller
{
    public function index(Task $task)
    {
        $comments = $task->comments()
            ->with('user')
            ->latest()
            ->get();

        return view('tasks.comments', compact(
            'task',
            'comments'
        ));
    }

    public function store(Request $request, Task $task)
    {
        TaskComment::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return back()
            ->with('success', 'Comment Added Successfully');
    }
    public function allComments()
    {
        $comments = TaskComment::with([
            'task',
            'user'
        ])
            ->latest()
            ->get();

        return view(
            'tasks.all-comments',
            compact('comments')
        );
    }
}

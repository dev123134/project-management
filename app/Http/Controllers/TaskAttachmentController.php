<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskAttachmentController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();

        $attachments = TaskAttachment::with([
            'task',
            'user'
        ])->latest()->get();

        return view(
            'tasks.attachments',
            compact(
                'tasks',
                'attachments'
            )
        );
    }

    public function store(Request $request)
    {
        $file = $request->file('file');

        $path = $file->store(
            'task_attachments',
            'public'
        );

        TaskAttachment::create([
            'task_id'   => $request->task_id,
            'user_id'   => Auth::id(),
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
        ]);

        return back()
            ->with(
                'success',
                'File Uploaded Successfully'
            );
    }
}
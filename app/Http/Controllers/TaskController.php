<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Mail\TaskAssignedMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\NotificationController;


class TaskController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $tasks = Task::with(['project', 'assignee'])
                ->oldest()
                ->get();
        } elseif ($user->role == 'freelancer') {
            $tasks = Task::with(['project', 'assignee'])
                ->where('assigned_to', $user->id)
                ->oldest()
                ->get();
        } else {
            $tasks = Task::with(['project', 'assignee'])
                ->where('assigned_to', $user->id)
                ->oldest()
                ->get();
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $projects = Project::all();

        $users = User::whereIn('role', ['freelancer', 'employee'])
            ->get();

        return view('tasks.create', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }
        $task = Task::create([
            'project_id' => $request->project_id,
            'assigned_by' => Auth::id(),
            'assigned_to' => $request->assigned_to,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'assigned_date' => $request->assigned_date,
            'due_date' => $request->due_date,
            'github_link' => $request->github_link,
            'status' => 'Pending',
        ]);

        $task->load(['project', 'assigner', 'assignee']);

        NotificationController::createNotification(
            $task->assigned_to,
            'New Task Assigned',
            'A new task "' . $task->title . '" has been assigned to you.',
            'task',
            route('tasks.index'),
            'fas fa-tasks',
            'primary'
        );

        Mail::to($task->assignee->email)->send(
            new TaskAssignedMail($task)
        );

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }
        $projects = Project::all();
        $users = User::all();

        return view('tasks.edit', compact(
            'task',
            'projects',
            'users'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $task->update([
            'project_id'  => $request->project_id,
            'assigned_to' => $request->assigned_to,
            'title'       => $request->title,
            'description' => $request->description,
            'priority'    => $request->priority,
            'assigned_date' => $request->assigned_date,
            'due_date'    => $request->due_date,
            'github_link' => $request->github_link,
            'status'      => $request->status,
        ]);
        return redirect()
            ->route('tasks.index')
            ->with(
                'success',
                'Task Updated Successfully'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task Moved To Trash Successfully');
    }
    public function trash()
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $tasks = Task::onlyTrashed()
            ->latest()
            ->get();

        return view('tasks.trash', compact('tasks'));
    }
    public function restore($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        Task::withTrashed()
            ->findOrFail($id)
            ->restore();

        return redirect()
            ->route('tasks.trash')
            ->with(
                'success',
                'Task Restored Successfully'
            );
    }

    public function assignedTasks()
    {
        $tasks = Task::with(['project', 'assignee'])
            ->where('assigned_to', Auth::id())
            ->oldest()
            ->get();

        return view('tasks.assigned', compact('tasks'));
    }
    public function updateStatus(Request $request, Task $task)
    {
        $task->update([
            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Task Status Updated Successfully'
        );
    }
}

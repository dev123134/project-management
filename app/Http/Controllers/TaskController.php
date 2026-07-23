<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = Auth::user();

    if($user->role == 'admin')
    {
        $tasks = Task::with(['project','assignee'])
                    ->latest()
                    ->get();
    }
    elseif($user->role == 'freelancer')
    {
        $tasks = Task::with(['project','assignee'])
                    ->where('assigned_to', $user->id)
                    ->latest()
                    ->get();
    }
    else
    {
        $tasks = Task::with(['project','assignee'])
                    ->where('assigned_to', $user->id)
                    ->latest()
                    ->get();
    }

    return view('tasks.index', compact('tasks'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        $users = User::all();

        return view('tasks.create', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Task::create([
            'project_id'  => $request->project_id,
            'assigned_by' => Auth::id(),
            'assigned_to' => $request->assigned_to,
            'title'       => $request->title,
            'description' => $request->description,
            'priority'    => $request->priority,
            'due_date'    => $request->due_date,
            'status'      => 'Pending',
        ]);

        return redirect()->route('tasks.index')
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
        $task->update([

            'project_id' => $request->project_id,

            'assigned_to' => $request->assigned_to,

            'title' => $request->title,

            'description' => $request->description,

            'priority' => $request->priority,

            'due_date' => $request->due_date,

            'status' => $request->status,

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
    $task->delete();

    return redirect()
        ->route('tasks.index')
        ->with('success', 'Task Moved To Trash Successfully');
}
    public function trash()
{
    $user = Auth::user();

    if ($user->role == 'admin') {

        $tasks = Task::onlyTrashed()
                    ->latest()
                    ->get();

    } else {

        $tasks = Task::onlyTrashed()
            ->latest()
            ->get();
    }

    return view('tasks.trash', compact('tasks'));
}
    public function restore($id)
    {
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
            ->latest()
            ->get();

        return view('tasks.assigned', compact('tasks'));
    }
    public function updateStatus(Request $request, Task $task)
{
    $task->update([
        'status' => $request->status
    ]);

    return back()
        ->with('success', 'Task Status Updated Successfully');
}
}

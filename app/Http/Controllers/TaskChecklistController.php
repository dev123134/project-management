<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskChecklist;

class TaskChecklistController extends Controller
{
    /**
     * Show Checklist Page
     */
    public function index($taskId)
    {
        $task = Task::findOrFail($taskId);

        $checklists = TaskChecklist::where('task_id', $taskId)
            ->orderBy('id')
            ->get();

        return view(
            'tasks.checklist',
            compact(
                'task',
                'checklists'
            )
        );
    }

    /**
     * Save Checklist
     */
    public function store(Request $request, $taskId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        TaskChecklist::create([

            'task_id' => $taskId,

            'title' => $request->title,

            'is_completed' => false,

        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Checklist Added Successfully.'
            );
    }
    public function update(Request $request, $taskId)
{
    $task = Task::findOrFail($taskId);

    TaskChecklist::where('task_id', $task->id)
        ->update([
            'is_completed' => false
        ]);

    if ($request->has('completed')) {

        TaskChecklist::whereIn('id', $request->completed)
            ->update([
                'is_completed' => true
            ]);
    }

    return redirect()
        ->back()
        ->with(
            'success',
            'Checklist Updated Successfully.'
        );
}
}
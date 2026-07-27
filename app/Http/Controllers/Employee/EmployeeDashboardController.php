<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Project;
use App\Models\DailyUpdate;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Assigned Tasks
        $assignedTasks = Task::where('assigned_to', $user->id)->count();

        // Completed Tasks
        $completedTasks = Task::where('assigned_to', $user->id)
            ->where('status', 'completed')
            ->count();

        // Pending Tasks
        $pendingTasks = Task::where('assigned_to', $user->id)
            ->where('status', 'pending')
            ->count();

        // Assigned Projects
        $assignedProjects = Project::whereHas('members', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        // Today's Updates
        $todayUpdates = DailyUpdate::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count();

        return view('employee.dashboard', compact(
            'assignedTasks',
            'completedTasks',
            'pendingTasks',
            'assignedProjects',
            'todayUpdates'
        ));
    }
}
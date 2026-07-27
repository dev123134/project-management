<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Project;
use App\Models\DailyUpdate;

class FreelancerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total Tasks
        $totalTasks = Task::where('assigned_to', $user->id)->count();

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

        // Today's Work Updates
        $todayUpdates = DailyUpdate::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count();

        return view('freelancer.dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'assignedProjects',
            'todayUpdates'
        ));
    }
}
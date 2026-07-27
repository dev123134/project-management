<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total Projects
        $totalProjects = Project::where('client_id', $user->id)->count();

        // Completed Projects
        $completedProjects = Project::where('client_id', $user->id)
            ->where('status', 'Completed')
            ->count();

        // Active Projects
        $activeProjects = Project::where('client_id', $user->id)
            ->where('status', 'In Progress')
            ->count();

        // Pending Projects
        $pendingProjects = Project::where('client_id', $user->id)
            ->where('status', 'Pending')
            ->count();

        // Total Budget
        $totalBudget = Project::where('client_id', $user->id)
            ->sum('budget');

        return view('client.dashboard', compact(
            'totalProjects',
            'completedProjects',
            'activeProjects',
            'pendingProjects',
            'totalBudget'
        ));
    }
}
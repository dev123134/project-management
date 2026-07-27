<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Users
        $totalUsers = User::count();
        $totalClients = User::where('role', 'client')->count();
        $totalFreelancers = User::where('role', 'freelancer')->count();
        $totalEmployees = User::where('role', 'employee')->count();

        // Projects
        $totalProjects = Project::count();
        $completedProjects = Project::where('status', 'Completed')->count();
        $pendingProjects = Project::where('status', 'Pending')->count();

        // Tasks
        $totalTasks = Task::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalClients',
            'totalFreelancers',
            'totalEmployees',
            'totalProjects',
            'completedProjects',
            'pendingProjects',
            'totalTasks'
        ));
    }
}
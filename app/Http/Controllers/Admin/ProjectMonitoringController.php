<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Carbon\Carbon;

class ProjectMonitoringController extends Controller
{
    public function index()
    {
        $projects = Project::withCount('members')
    ->latest()
    ->get()
    ->each(function ($project) {
        $project->progress = $project->progress;
    });

        return view('admin.project-monitoring.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $project->load([
            'members.user',
            'milestones',
            'dailyUpdates',
        ]);

        return view(
            'admin.project-monitoring.show',
            compact('project')
        );
    }

   public function delayed()
{
    $projects = Project::whereDate('deadline', '<', now())
        ->where('status', '!=', 'Completed')
        ->latest()
        ->get();

    return view('admin.project-monitoring.delayed', compact('projects'));
}

    public function completed()
{
    $projects = Project::where('status', 'Completed')
        ->latest()
        ->get();

    return view('admin.project-monitoring.completed', compact('projects'));
}
}
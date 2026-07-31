<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Milestone;



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
        // Total Revenue
        $totalRevenue = Project::sum('budget');

        // Current Month Revenue
        $currentMonthRevenue = Project::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('budget');

        // Last Month Revenue
        $lastMonth = Carbon::now()->subMonthNoOverflow();
        $lastMonthRevenue = Project::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('budget');

        // Revenue Growth %
        if ($lastMonthRevenue > 0) {
            $revenueGrowth = (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
        } else {
            $revenueGrowth = 100;
        }
        $currentMonth = Carbon::now();
        $lastMonth = Carbon::now()->subMonthNoOverflow();


        $currentUsers = User::whereMonth('created_at', $currentMonth->month)
            ->whereYear('created_at', $currentMonth->year)
            ->count();

        $lastUsers = User::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $userGrowth = $lastUsers > 0
            ? (($currentUsers - $lastUsers) / $lastUsers) * 100
            : 0;
        $userGrowth = min(100, max(0, round($userGrowth, 1)));


        $currentProjects = Project::whereMonth('created_at', $currentMonth->month)
            ->whereYear('created_at', $currentMonth->year)
            ->count();

        $lastProjects = Project::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $projectGrowth = $lastProjects > 0
            ? (($currentProjects - $lastProjects) / $lastProjects) * 100
            : 0;
        $projectGrowth = min(100, max(0, round($projectGrowth, 1)));


        $currentClients = User::where('role', 'client')
            ->whereMonth('created_at', $currentMonth->month)
            ->whereYear('created_at', $currentMonth->year)
            ->count();

        $lastClients = User::where('role', 'client')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $clientGrowth = $lastClients > 0
            ? (($currentClients - $lastClients) / $lastClients) * 100
            : 0;
        $clientGrowth = min(100, max(0, round($clientGrowth, 1)));



        $currentTasks = Task::whereMonth('created_at', $currentMonth->month)
            ->whereYear('created_at', $currentMonth->year)
            ->count();

        $lastTasks = Task::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $taskGrowth = $lastTasks > 0
            ? (($currentTasks - $lastTasks) / $lastTasks) * 100
            : 0;
        $taskGrowth = min(100, max(0, round($taskGrowth, 1)));



        $totalRevenue = Project::sum('budget');

        $currentRevenue = Project::whereMonth('created_at', $currentMonth->month)
            ->whereYear('created_at', $currentMonth->year)
            ->sum('budget');

        $lastRevenue = Project::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('budget');

        $revenueGrowth = $lastRevenue > 0
            ? (($currentRevenue - $lastRevenue) / $lastRevenue) * 100
            : 0;
        $revenueGrowth = min(100, max(0, round($revenueGrowth, 1)));

        //chart 
        $currentDate = Carbon::now();
        $daysInMonth = $currentDate->daysInMonth;

        $ranges = [
            [1, 10],
            [11, 20],
            [21, $daysInMonth],
        ];

        $revenueLabels = [];
        $revenueValues = [];

        foreach ($ranges as [$start, $end]) {

            $startDate = Carbon::create($currentDate->year, $currentDate->month, $start)->startOfDay();
            $endDate   = Carbon::create($currentDate->year, $currentDate->month, $end)->endOfDay();

            $total = Project::whereNull('deleted_at')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('budget');

            $revenueLabels[] = $start . '-' . $end;
            $revenueValues[] = (float) $total;
        }

        $completedProjects = Project::whereNull('deleted_at')
            ->where('status', 'Completed')
            ->count();

        $inProgressProjects = Project::whereNull('deleted_at')
            ->where('status', 'In Progress')
            ->count();

        $pendingProjects = Project::whereNull('deleted_at')
            ->where('status', 'Pending')
            ->count();

        $totalProjectCount = $completedProjects + $inProgressProjects + $pendingProjects;

        $completedPercentage = $totalProjectCount > 0
            ? round(($completedProjects / $totalProjectCount) * 100, 1)
            : 0;

        $inProgressPercentage = $totalProjectCount > 0
            ? round(($inProgressProjects / $totalProjectCount) * 100, 1)
            : 0;

        $pendingPercentage = $totalProjectCount > 0
            ? round(($pendingProjects / $totalProjectCount) * 100, 1)
            : 0;


        /*
|--------------------------------------------------------------------------
| Task Overview
|--------------------------------------------------------------------------
*/
        $taskFilter = request('task_filter', 'this_week');
        $completedTasks = Task::whereNull('deleted_at')
            ->where('status', 'Completed')
            ->count();

        $inProgressTasks = Task::whereNull('deleted_at')
            ->where('status', 'In Progress')
            ->count();

        $pendingTasks = Task::whereNull('deleted_at')
            ->where('status', 'Pending')
            ->count();

        $totalTaskCount = $completedTasks + $inProgressTasks + $pendingTasks;

        $completedTaskPercentage = $totalTaskCount > 0
            ? round(($completedTasks / $totalTaskCount) * 100, 1)
            : 0;

        $inProgressTaskPercentage = $totalTaskCount > 0
            ? round(($inProgressTasks / $totalTaskCount) * 100, 1)
            : 0;

        $pendingTaskPercentage = $totalTaskCount > 0
            ? round(($pendingTasks / $totalTaskCount) * 100, 1)
            : 0;

        $recentActivities = ActivityLog::latest()
            ->take(4)
            ->get();

        $teamWorkload = User::whereIn('role', ['employee', 'freelancer'])
            ->get()
            ->map(function ($user) {

                $projectCount = \App\Models\ProjectMember::where('user_id', $user->id)->count();

                return [
                    'name' => $user->name,
                    'role' => ucfirst($user->role),
                    'projects' => $projectCount,
                    'workload' => min($projectCount * 25, 100)
                ];
            });

        $upcomingDeadlines = Project::whereNull('deleted_at')
            ->whereDate('deadline', '>=', now())
            ->orderBy('deadline', 'asc')
            ->take(4)
            ->get();

        $projectStatus = Project::whereNull('deleted_at')->take(4)->get();

        foreach ($projectStatus as $project) {

            $total = Milestone::where('project_id', $project->id)->count();

            $completed = Milestone::where('project_id', $project->id)
                ->where('status', 'Completed')
                ->count();

            $project->progress = $total > 0
                ? round(($completed / $total) * 100)
                : 0;
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalClients',
            'totalFreelancers',
            'totalEmployees',
            'totalProjects',

            'completedProjects',
            'inProgressProjects',
            'pendingProjects',

            'totalTasks',

            'userGrowth',
            'projectGrowth',
            'clientGrowth',
            'taskGrowth',

            'totalRevenue',
            'revenueGrowth',
            'revenueLabels',
            'revenueValues',

            'totalProjectCount',
            'completedPercentage',
            'inProgressPercentage',
            'pendingPercentage',
            'completedTasks',
            'inProgressTasks',
            'pendingTasks',

            'totalTaskCount',

            'completedTaskPercentage',
            'inProgressTaskPercentage',
            'pendingTaskPercentage',

            'recentActivities',
            'teamWorkload',
            'upcomingDeadlines',
            'projectStatus'
        ));
    }
    public function taskFilter(Request $request)
    {
        $filter = $request->filter;

        $tasks = Task::whereNull('deleted_at');

        if ($filter == 'this_week') {

            $tasks->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
        } elseif ($filter == 'this_month') {

            $tasks->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year);
        } elseif ($filter == 'this_year') {

            $tasks->whereYear('created_at', Carbon::now()->year);
        }

        $completed = (clone $tasks)
            ->where('status', 'Completed')
            ->count();

        $inProgress = (clone $tasks)
            ->where('status', 'In Progress')
            ->count();

        $pending = (clone $tasks)
            ->where('status', 'Pending')
            ->count();

        $total = $completed + $inProgress + $pending;

        return response()->json([

            'total' => $total,

            'completed' => $completed,

            'completed_percentage' => $total ? round(($completed / $total) * 100, 1) : 0,

            'in_progress' => $inProgress,

            'in_progress_percentage' => $total ? round(($inProgress / $total) * 100, 1) : 0,

            'pending' => $pending,

            'pending_percentage' => $total ? round(($pending / $total) * 100, 1) : 0,

        ]);
    }
    public function revenueFilter(Request $request)
    {
        $filter = $request->filter;

        if ($filter == 'this_month') {

            $date = Carbon::now();
            $days = $date->daysInMonth;

            $ranges = [
                [1, 10],
                [11, 20],
                [21, $days],
            ];

            $labels = [];
            $values = [];

            foreach ($ranges as [$start, $end]) {

                $startDate = Carbon::create($date->year, $date->month, $start)->startOfDay();
                $endDate   = Carbon::create($date->year, $date->month, $end)->endOfDay();

                $labels[] = $start . '-' . $end;

                $values[] = (float) Project::whereNull('deleted_at')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->sum('budget');
            }

          $revenue = Project::whereNull('deleted_at')
    ->whereMonth('created_at', $date->month)
    ->whereYear('created_at', $date->year)
    ->sum('budget');
        } elseif ($filter == 'last_month') {

            $date = Carbon::now()->subMonthNoOverflow(); // month-end overflow bug fix
            $days = $date->daysInMonth;

            $ranges = [
                [1, 10],
                [11, 20],
                [21, $days],
            ];

            $labels = [];
            $values = [];

            foreach ($ranges as [$start, $end]) {

                $startDate = Carbon::create($date->year, $date->month, $start)->startOfDay();
                $endDate   = Carbon::create($date->year, $date->month, $end)->endOfDay();

                $labels[] = $start . '-' . $end;

                $values[] = (float) Project::whereNull('deleted_at')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->sum('budget');
            }

         $revenue = Project::whereNull('deleted_at')
    ->whereMonth('created_at', $date->month)
    ->whereYear('created_at', $date->year)
    ->sum('budget');
        } else {

            $date = Carbon::now();

            $labels = [];
            $values = [];

            for ($month = 1; $month <= 12; $month++) {

                $labels[] = Carbon::create()->month($month)->format('M');

                $values[] = (float) Project::whereNull('deleted_at')
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $month)
                    ->sum('budget');
            }

          $revenue = Project::whereNull('deleted_at')
    ->whereYear('created_at', $date->year)
    ->sum('budget');
        }

        return response()->json([
            'revenue' => $revenue,
            'labels' => $labels,
            'values' => $values
        ]);
    }
}

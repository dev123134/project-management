<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Milestone;
use Illuminate\Http\Request;
use App\Models\DailyUpdate;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ProjectMember;
use App\Models\Message;
use App\Models\GroupMessage;
use App\Models\Group;
use Barryvdh\DomPDF\Facade\Pdf;



class ReportController extends Controller
{
    public function projectSummary()
    {
        $totalProjects = Project::count();

        $completedProjects = Project::where('status', 'Completed')->count();

        $activeProjects = Project::whereNotIn('status', ['Completed'])
            ->whereDate('deadline', '>=', now())
            ->count();

        $delayedProjects = Project::where('status', '!=', 'Completed')
            ->whereDate('deadline', '<', now())
            ->count();

        $totalMilestones = Milestone::count();

        $completedMilestones = Milestone::where('status', 'Completed')->count();

        $overallProgress = $totalMilestones > 0
            ? round(($completedMilestones / $totalMilestones) * 100, 2)
            : 0;

        return view('admin.reports.project-summary', compact(
            'totalProjects',
            'activeProjects',
            'completedProjects',
            'delayedProjects',
            'totalMilestones',
            'completedMilestones',
            'overallProgress'
        ));
    }

    public function projectStatus(Request $request)
    {
        $query = Project::query();

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.reports.project-status', [

            'projects' => $projects,

            'totalProjects' => Project::count(),

            'pendingProjects' => Project::where('status', 'Pending')->count(),

            'inProgressProjects' => Project::where('status', 'In Progress')->count(),

            'completedProjects' => Project::where('status', 'Completed')->count(),

        ]);
    }

    public function projectDetails(Project $project)
    {
        $milestones = Milestone::where('project_id', $project->id)
            ->latest()
            ->get();

        $dailyUpdates = DailyUpdate::where('project_id', $project->id)
            ->latest()
            ->get();

        $activityLogs = ActivityLog::latest()
            ->take(20)
            ->get();

        $teamMembers = DB::table('project_members')
            ->join('users', 'project_members.user_id', '=', 'users.id')
            ->where('project_members.project_id', $project->id)
            ->select('users.name', 'users.email', 'users.role')
            ->get();

        $totalMilestones = $milestones->count();

        $completedMilestones = $milestones
            ->where('status', 'Completed')
            ->count();

        $progress = $totalMilestones > 0
            ? round(($completedMilestones / $totalMilestones) * 100)
            : 0;

        return view(
            'admin.reports.project-details',
            compact(
                'project',
                'milestones',
                'dailyUpdates',
                'activityLogs',
                'teamMembers',
                'progress'
            )
        );
    }

    public function userWise(Request $request)
    {
        $query = User::where('role', '!=', 'admin');



        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {

            $query->where('role', $request->role);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalUsers = User::where('role', '!=', 'admin')->count();

        $freelancers = User::where('role', 'freelancer')->count();

        $employees = User::where('role', 'employee')->count();

        $clients = User::where('role', 'client')->count();

        return view(
            'admin.reports.user-wise',
            compact(
                'users',
                'totalUsers',
                'freelancers',
                'employees',
                'clients'
            )
        );
    }

    public function userDetails(User $user)
    {
        $assignedProjects = ProjectMember::join(
            'projects',
            'project_members.project_id',
            '=',
            'projects.id'
        )
            ->where('project_members.user_id', $user->id)
            ->select(
                'projects.*'
            )
            ->get();

        $dailyUpdates = DailyUpdate::where(
            'user_id',
            $user->id
        )
            ->latest()
            ->get();

        return view(
            'admin.reports.user-details',
            compact(
                'user',
                'assignedProjects',
                'dailyUpdates'
            )
        );
    }

 public function milestoneReport(Request $request)
{
    $query = Milestone::with('project');

    if ($request->filled('search')) {

        $query->where('title', 'like', '%' . $request->search . '%');

    }

    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    $milestones = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $totalMilestones = Milestone::count();

    $pendingMilestones = Milestone::where('status', 'Pending')->count();

    $completedMilestones = Milestone::where('status', 'Completed')->count();

    return view(
        'admin.reports.milestone-report',
        compact(
            'milestones',
            'totalMilestones',
            'pendingMilestones',
            'completedMilestones'
        )
    );
}

public function milestoneDetails(Milestone $milestone)
{
    $project = $milestone->project;

    $teamMembers = DB::table('project_members')
        ->join('users', 'project_members.user_id', '=', 'users.id')
        ->where('project_members.project_id', $project->id)
        ->select('users.name', 'users.email', 'users.role')
        ->get();

    $dailyUpdates = DailyUpdate::where('project_id', $project->id)
        ->latest()
        ->get();

    return view(
        'admin.reports.milestone-details',
        compact(
            'milestone',
            'project',
            'teamMembers',
            'dailyUpdates'
        )
    );
}

public function dailyWorkReport(Request $request)
{
    $query = DailyUpdate::with(['project', 'user']);

    if ($request->filled('search')) {

        $query->where('work_update', 'like', '%' . $request->search . '%');

    }

    if ($request->filled('project')) {

        $query->where('project_id', $request->project);

    }

    if ($request->filled('user')) {

        $query->where('user_id', $request->user);

    }

    if ($request->filled('date')) {

        $query->whereDate('work_date', $request->date);

    }

    $dailyWorks = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $projects = Project::orderBy('title')->get();

    $users = User::where('role', '!=', 'admin')
        ->orderBy('name')
        ->get();

    $totalWorks = DailyUpdate::count();

    $todayWorks = DailyUpdate::whereDate('work_date', today())->count();

    $thisMonthWorks = DailyUpdate::whereMonth('work_date', now()->month)
        ->whereYear('work_date', now()->year)
        ->count();

    return view(
        'admin.reports.daily-work-report',
        compact(
            'dailyWorks',
            'projects',
            'users',
            'totalWorks',
            'todayWorks',
            'thisMonthWorks'
        )
    );
}

public function dailyWorkDetails(DailyUpdate $dailyWork)
{
    $dailyWork->load(['project', 'user']);

    return view(
        'admin.reports.daily-work-details',
        compact('dailyWork')
    );
}

public function activityLogReport(Request $request)
{
    $query = ActivityLog::with('user');

    if ($request->filled('search')) {

        $query->where('action', 'like', '%' . $request->search . '%');

    }

    if ($request->filled('user')) {

        $query->where('user_id', $request->user);

    }

    if ($request->filled('date')) {

        $query->whereDate('created_at', $request->date);

    }

    $activityLogs = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $users = User::where('role', '!=', 'admin')
        ->orderBy('name')
        ->get();

    $totalLogs = ActivityLog::count();

    $todayLogs = ActivityLog::whereDate('created_at', today())->count();

    $thisMonthLogs = ActivityLog::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

    return view(
        'admin.reports.activity-log-report',
        compact(
            'activityLogs',
            'users',
            'totalLogs',
            'todayLogs',
            'thisMonthLogs'
        )
    );
}

public function activityLogDetails(ActivityLog $activityLog)
{
    $activityLog->load('user');

    return view(
        'admin.reports.activity-log-details',
        compact('activityLog')
    );
}

public function chatUsageReport(Request $request)
{
    $query = Message::with(['sender', 'receiver']);

    if ($request->filled('search')) {
        $query->where('message', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('sender')) {
        $query->where('sender_id', $request->sender);
    }

    if ($request->filled('receiver')) {
        $query->where('receiver_id', $request->receiver);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $privateMessages = $query->latest()->paginate(10)->withQueryString();

    $users = User::where('role', '!=', 'admin')->orderBy('name')->get();

    $groups = Group::orderBy('name')->get();

    $totalMessages = Message::count() + GroupMessage::count();

    $privateCount = Message::count();

    $groupCount = GroupMessage::count();

    $todayMessages =
        Message::whereDate('created_at', today())->count()
        + GroupMessage::whereDate('created_at', today())->count();

    return view('admin.reports.chat-usage-report', compact(
        'privateMessages',
        'users',
        'groups',
        'totalMessages',
        'privateCount',
        'groupCount',
        'todayMessages'
    ));
}

public function chatDetails(Message $message)
{
    $message->load(['sender', 'receiver']);

    return view(
        'admin.reports.chat-details',
        compact('message')
    );
}

public function groupChatReport(Request $request)
{
    $query = GroupMessage::with(['user', 'group']);

    if ($request->filled('search')) {
        $query->where('message', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('user')) {
        $query->where('user_id', $request->user);
    }

    if ($request->filled('group')) {
        $query->where('group_id', $request->group);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $groupMessages = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $users = User::where('role', '!=', 'admin')
        ->orderBy('name')
        ->get();

    $groups = Group::orderBy('name')->get();

    $totalMessages = GroupMessage::count();

    $todayMessages = GroupMessage::whereDate('created_at', today())->count();

    return view(
        'admin.reports.group-chat-report',
        compact(
            'groupMessages',
            'users',
            'groups',
            'totalMessages',
            'todayMessages'
        )
    );
}

public function groupChatDetails(GroupMessage $groupMessage)
{
    $groupMessage->load(['user', 'group']);

    return view(
        'admin.reports.group-chat-details',
        compact('groupMessage')
    );
}

public function projectSummaryPdf()
{
    $projects = Project::latest()->get();

    $pdf = Pdf::loadView(
        'admin.reports.pdf.project-summary-pdf',
        compact('projects')
    );

    return $pdf->download('project-summary-report.pdf');
}

}

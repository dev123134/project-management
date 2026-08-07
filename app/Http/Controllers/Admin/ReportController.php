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
use Symfony\Component\HttpFoundation\StreamedResponse;


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
        $projects = Project::oldest()->get();

        $pdf = Pdf::loadView(
            'admin.reports.pdf.project-summary-pdf',
            compact('projects')
        );

        return $pdf->download('project-summary-report.pdf');
    }

    public function projectSummaryCsv()
    {
        $fileName = 'project-summary-report.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $projects = Project::with(['client', 'members.user'])->get();

        $callback = function () use ($projects) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [

                'Project ID',
                'Client Name',
                'Project Start Date',
                'Service Location',
                'Nature Of Work',
                'Work Details',
                'Project Value',
                'Deadline',
                'Working Employees / Freelancer',
                'Billing Address',
                'Invoice Status',
                'Payment Status',
                'Project Status'

            ]);

            foreach ($projects as $project) {

                $teamMembers = $project->members
                    ->pluck('user.name')
                    ->implode(', ');

                fputcsv($file, [

                    $project->id,

                    optional($project->client)->name,

                    $project->start_date,

                    $project->service_location,

                    $project->nature_of_work,

                    $project->description,

                    $project->budget,

                    $project->deadline,

                    $teamMembers,

                    $project->billing_address,

                    $project->invoice_status,

                    $project->payment_status,

                    $project->status,

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function projectStatusPdf()
    {
        $projects = Project::orderBy('deadline')->get();

        $pdf = Pdf::loadView(
            'admin.reports.pdf.project-status-pdf',
            compact('projects')
        );

        return $pdf->download('project-status-report.pdf');
    }

    public function projectStatusCsv()
    {
        $fileName = 'project-status-report.csv';

        $headers = [

            'Content-Type' => 'text/csv',

            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',

        ];

        $projects = Project::orderBy('deadline')->get();

        $callback = function () use ($projects) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [

                'Project ID',
                'Project Name',
                'Status',
                'Start Date',
                'Deadline',
                'Budget',

            ]);

            foreach ($projects as $project) {

                fputcsv($file, [

                    $project->id,
                    $project->title,
                    $project->status,
                    $project->start_date,
                    $project->deadline,
                    $project->budget,

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function userWisePdf()
    {
        $users = User::where('role', '!=', 'admin')
            ->orderBy('name')
            ->get();

        $pdf = Pdf::loadView(
            'admin.reports.pdf.user-wise-pdf',
            compact('users')
        );

        return $pdf->download('user-wise-report.pdf');
    }

    public function userWiseCsv()
    {
        $fileName = 'user-wise-report.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $users = User::where('role', '!=', 'admin')
            ->orderBy('name')
            ->get();

        $callback = function () use ($users) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'User ID',
                'Name',
                'Email',
                'Role',
                'Assigned Projects',
                'Daily Updates',
            ]);

            foreach ($users as $user) {

                fputcsv($file, [

                    $user->id,
                    $user->name,
                    $user->email,
                    ucfirst($user->role),
                    $user->projects()->count(),
                    $user->dailyUpdates()->count(),

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function milestonePdf()
    {
        $milestones = Milestone::with('project')
            ->orderBy('due_date')
            ->get();

        $pdf = Pdf::loadView(
            'admin.reports.pdf.milestone-report-pdf',
            compact('milestones')
        );

        return $pdf->download('milestone-report.pdf');
    }

    public function milestoneCsv()
    {
        $fileName = 'milestone-report.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $milestones = Milestone::with('project')
            ->orderBy('due_date')
            ->get();

        $callback = function () use ($milestones) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [

                'Milestone ID',
                'Project Name',
                'Milestone Title',
                'Due Date',
                'Status',
                'Created Date',

            ]);

            foreach ($milestones as $milestone) {

                fputcsv($file, [

                    $milestone->id,

                    optional($milestone->project)->title,

                    $milestone->title,

                    $milestone->due_date,

                    $milestone->status,

                    $milestone->created_at
                        ? $milestone->created_at->format('d M Y')
                        : '',

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function dailyWorkPdf()
    {
        $dailyUpdates = DailyUpdate::with(['project', 'user'])
            ->oldest()
            ->get();

        $pdf = Pdf::loadView(
            'admin.reports.pdf.daily-work-report-pdf',
            compact('dailyUpdates')
        );

        return $pdf->download('daily-work-report.pdf');
    }

    public function dailyWorkCsv()
    {
        $fileName = 'daily-work-report.csv';

        $headers = [

            'Content-Type' => 'text/csv',

            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',

        ];

        $dailyUpdates = DailyUpdate::with(['project', 'user'])
            ->latest()
            ->get();

        $callback = function () use ($dailyUpdates) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [

                'Update ID',
                'Project Name',
                'Employee',
                'Today Work',
                'Work Date',
                'Created At',

            ]);

            foreach ($dailyUpdates as $update) {

                fputcsv($file, [

                    $update->id,

                    optional($update->project)->title,

                    optional($update->user)->name,

                    $update->work_update,

                    $update->work_date,

                    $update->created_at
                        ? $update->created_at->format('d M Y')
                        : '',

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function activityLogPdf()
{
    $activityLogs = ActivityLog::with('user')
        ->oldest()
        ->get();

    $pdf = Pdf::loadView(
        'admin.reports.pdf.activity-log-pdf',
        compact('activityLogs')
    );

    return $pdf->download('activity-log-report.pdf');
}

public function activityLogCsv()
{
    $fileName = 'activity-log-report.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    ];

    $activityLogs = ActivityLog::with('user')
        ->oldest()
        ->get();

    $callback = function () use ($activityLogs) {

        $file = fopen('php://output', 'w');

        fputcsv($file, [

            'Log ID',
            'User Name',
            'Action',
            'Date',
            'Time',

        ]);

        foreach ($activityLogs as $log) {

            fputcsv($file, [

                $log->id,

                optional($log->user)->name,

                $log->action,

                $log->created_at
                    ? $log->created_at->format('d M Y')
                    : '',

                $log->created_at
                    ? $log->created_at->format('h:i A')
                    : '',

            ]);

        }

        fclose($file);

    };

    return response()->stream($callback, 200, $headers);
}

public function chatUsagePdf()
{
    $messages = Message::with(['sender', 'receiver'])
        ->oldest()
        ->get();

    $pdf = Pdf::loadView(
        'admin.reports.pdf.chat-usage-pdf',
        compact('messages')
    );

    return $pdf->download('chat-usage-report.pdf');
}

public function chatUsageCsv()
{
    $fileName = 'chat-usage-report.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    ];

    $messages = Message::with(['sender', 'receiver'])
        ->oldest()
        ->get();

    $callback = function () use ($messages) {

        $file = fopen('php://output', 'w');

        fputcsv($file, [

            'Message ID',
            'Sender',
            'Receiver',
            'Message',
            'Attachment',
            'Date',
            'Time',

        ]);

        foreach ($messages as $message) {

            fputcsv($file, [

                $message->id,

                optional($message->sender)->name,

                optional($message->receiver)->name,

                strip_tags($message->message),

                $message->file ? 'Yes' : 'No',

                $message->created_at
                    ? $message->created_at->format('d M Y')
                    : '',

                $message->created_at
                    ? $message->created_at->format('h:i A')
                    : '',

            ]);

        }

        fclose($file);

    };

    return response()->stream($callback, 200, $headers);
}

public function groupChatPdf()
{
    $groupMessages = GroupMessage::with([
        'group',
        'user'
    ])
    ->oldest()
    ->get();

    $pdf = Pdf::loadView(
        'admin.reports.pdf.group-chat-pdf',
        compact('groupMessages')
    );

    return $pdf->download('group-chat-report.pdf');
}

public function groupChatCsv()
{
    $fileName = 'group-chat-report.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    ];

    $groupMessages = GroupMessage::with([
        'group',
        'user'
    ])
    ->oldest()
    ->get();

    $callback = function () use ($groupMessages) {

        $file = fopen('php://output', 'w');

        fputcsv($file, [

            'Message ID',
            'Group Name',
            'Sender',
            'Message',
            'Attachment',
            'Date',
            'Time',

        ]);

        foreach ($groupMessages as $message) {

            fputcsv($file, [

                $message->id,

                optional($message->group)->name,

                optional($message->user)->name,

                strip_tags($message->message),

                $message->file ? 'Yes' : 'No',

                $message->created_at
                    ? $message->created_at->format('d M Y')
                    : '',

                $message->created_at
                    ? $message->created_at->format('h:i A')
                    : '',

            ]);

        }

        fclose($file);

    };

    return response()->stream($callback, 200, $headers);
}
}

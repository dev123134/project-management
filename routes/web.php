<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\DailyUpdateController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\TaskAttachmentController;
use App\Http\Controllers\ProjectFileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ChatMonitoringController;
use App\Http\Controllers\Admin\ProjectMonitoringController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\BackupController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\LoginHistoryController;
use App\Http\Controllers\Freelancer\FreelancerDashboardController;
use App\Http\Controllers\Client\ClientDashboardController;
use App\Http\Controllers\Employee\EmployeeDashboardController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\TaskChecklistController;





Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/users', [UserController::class, 'index'])
        ->name('admin.users.index');

    Route::get('/admin/users/create', [UserController::class, 'create'])
        ->name('admin.users.create');

    Route::post('/admin/users/store', [UserController::class, 'store'])
        ->name('admin.users.store');

    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])
        ->name('admin.users.edit');

    Route::put('/admin/users/{user}', [UserController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');

    Route::get('/admin/users/trash', [UserController::class, 'trash'])
        ->name('admin.users.trash');

    Route::patch('/admin/users/{id}/restore', [UserController::class, 'restore'])
        ->name('admin.users.restore');

    Route::delete('/admin/users/{id}/force-delete', [UserController::class, 'forceDelete'])
        ->name('admin.users.forceDelete');

    Route::patch('/admin/users/{id}/block', [UserController::class, 'block'])
        ->name('admin.users.block');

    Route::patch('/admin/users/{id}/unblock', [UserController::class, 'unblock'])
        ->name('admin.users.unblock');

    Route::get('/admin/subscriptions', [SubscriptionController::class, 'index'])
        ->name('admin.subscriptions.index');

    Route::get('/admin/subscriptions/create', [SubscriptionController::class, 'create'])
        ->name('admin.subscriptions.create');

    Route::post('/admin/subscriptions', [SubscriptionController::class, 'store'])
        ->name('admin.subscriptions.store');

    Route::get('/admin/subscriptions/{id}/edit', [SubscriptionController::class, 'edit'])
        ->name('admin.subscriptions.edit');

    Route::put('/admin/subscriptions/{id}', [SubscriptionController::class, 'update'])
        ->name('admin.subscriptions.update');

    Route::delete('/admin/subscriptions/{id}', [SubscriptionController::class, 'destroy'])
        ->name('admin.subscriptions.destroy');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');

        Route::post('/backup/create', [BackupController::class, 'create'])->name('backup.create');

        Route::get('/backup/download/{file}', [BackupController::class, 'download'])->name('backup.download');

        Route::delete('/backup/delete/{file}', [BackupController::class, 'delete'])->name('backup.delete');

        Route::post('/backup/restore', [BackupController::class, 'restore'])
            ->name('backup.restore');
    });
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {



    Route::get('/chat-monitoring/private', [ChatMonitoringController::class, 'privateChats'])
        ->name('chat.private');

    Route::get('/chat-monitoring/groups', [ChatMonitoringController::class, 'groupChats'])
        ->name('chat.groups');

    Route::get(
        '/chat-monitoring/private/{sender}/{receiver}',
        [ChatMonitoringController::class, 'viewConversation']
    )
        ->name('admin.chat-monitoring.view');

    Route::get(
        '/chat-monitoring/private/{senderId}/{receiverId}',
        [ChatMonitoringController::class, 'viewConversation']
    )->name('chat.view');

    Route::get(
        '/chat-monitoring/groups/{group}',
        [ChatMonitoringController::class, 'viewGroupConversation']
    )->name('chat.group.view');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/project-monitoring', [ProjectMonitoringController::class, 'index'])->name('project.monitoring.index');
    Route::get('/project-monitoring/delayed', [ProjectMonitoringController::class, 'delayed'])->name('project.monitoring.delayed');
    Route::get('/project-monitoring/completed', [ProjectMonitoringController::class, 'completed'])->name('project.monitoring.completed');
    Route::get('/project-monitoring/{project}', [ProjectMonitoringController::class, 'show'])->name('project.monitoring.show');
});


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/reports/project-summary', [ReportController::class, 'projectSummary'])
            ->name('reports.project-summary');

        Route::get('/reports/project-status', [ReportController::class, 'projectStatus'])
            ->name('reports.project-status');

        Route::get('/reports/project-details/{project}', [ReportController::class, 'projectDetails'])
            ->name('reports.project-details');

        Route::get('/reports/user-wise', [ReportController::class, 'userWise'])
            ->name('reports.user-wise');

        Route::get('/reports/user-details/{user}', [ReportController::class, 'userDetails'])
            ->name('reports.user-details');

        Route::get('/reports/milestone-report', [ReportController::class, 'milestoneReport'])
            ->name('reports.milestone-report');

        Route::get('/reports/milestone-details/{milestone}', [ReportController::class, 'milestoneDetails'])
            ->name('reports.milestone-details');

        Route::get('/reports/daily-work-report', [ReportController::class, 'dailyWorkReport'])
            ->name('reports.daily-work-report');

        Route::get('/reports/daily-work-details/{dailyWork}', [ReportController::class, 'dailyWorkDetails'])
            ->name('reports.daily-work-details');

        Route::get('/reports/activity-log-report', [ReportController::class, 'activityLogReport'])
            ->name('reports.activity-log-report');

        Route::get('/reports/activity-log-details/{activityLog}', [ReportController::class, 'activityLogDetails'])
            ->name('reports.activity-log-details');

        Route::get('/reports/chat-usage-report', [ReportController::class, 'chatUsageReport'])
            ->name('reports.chat-usage-report');

        Route::get('/reports/chat-details/{message}', [ReportController::class, 'chatDetails'])
            ->name('reports.chat-details');

        Route::get('/reports/group-chat-report', [ReportController::class, 'groupChatReport'])
            ->name('reports.group-chat-report');

        Route::get('/reports/group-chat-details/{groupMessage}', [ReportController::class, 'groupChatDetails'])
            ->name('reports.group-chat-details');

        Route::get('/reports/project-summary/pdf', [ReportController::class, 'projectSummaryPdf'])
            ->name('reports.project-summary.pdf');
    });

Route::get('/client/dashboard', [ClientDashboardController::class, 'index'])
    ->middleware(['auth', 'client']);


Route::get('/freelancer/dashboard', [FreelancerDashboardController::class, 'index'])
    ->middleware(['auth', 'freelancer']);


Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'index'])
    ->middleware(['auth', 'employee']);



Route::get('/projects/create', [ProjectController::class, 'create'])
    ->name('projects.create');

Route::post('/projects/store', [ProjectController::class, 'store'])
    ->name('projects.store');

Route::get('/projects', [ProjectController::class, 'index'])
    ->name('projects.index');

Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])
    ->name('projects.edit');

Route::post('/projects/update/{id}', [ProjectController::class, 'update'])
    ->name('projects.update');

Route::get('/projects/delete/{id}', [ProjectController::class, 'destroy'])
    ->name('projects.delete');

Route::delete('/admin/project-monitoring/{id}', [ProjectController::class, 'destroy'])
    ->name('admin.project.destroy');
Route::get('/projects/team/{id}', [ProjectController::class, 'team']);
Route::get('/projects/team', [ProjectController::class, 'teamList']);
Route::post('/projects/team/store', [ProjectController::class, 'storeTeam']);
Route::get('/timeline', [ProjectController::class, 'timeline']);
Route::get('/projects/restore/{id}', [ProjectController::class, 'restore']);
Route::get('/projects/trash', [ProjectController::class, 'trash']);
Route::get('/projects/progress', [ProjectController::class, 'progress']);

Route::get('/milestones/create', [MilestoneController::class, 'create']);
Route::post('/milestones/store', [MilestoneController::class, 'store']);
Route::get('/milestones', [MilestoneController::class, 'index']);

Route::get('/daily-updates', [DailyUpdateController::class, 'index']);
Route::get('/daily-updates/create', [DailyUpdateController::class, 'create']);
Route::post('/daily-updates/store', [DailyUpdateController::class, 'store']);

Route::get('/activity-logs', [ActivityLogController::class, 'index']);

Route::get('/messages', [MessageController::class, 'index']);
Route::get('/messages/create', [MessageController::class, 'create']);
Route::post('/messages/store', [MessageController::class, 'store']);

Route::get('/chat/{id}', [MessageController::class, 'chat']);
Route::post('/chat/send', [MessageController::class, 'send']);


// Notification List
Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('notifications.index');

// Mark Single Notification as Read
Route::get('/notifications/read/{id}', [NotificationController::class, 'markRead'])
    ->name('notifications.read');

// Mark All Notifications as Read
Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])
    ->name('notifications.markAllRead');

// Delete Notification
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])
    ->name('notifications.destroy');
Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])
    ->name('notifications.unreadCount');

Route::get('/groups', [GroupController::class, 'index']);
Route::get('/groups/create', [GroupController::class, 'create']);
Route::post('/groups/store', [GroupController::class, 'store']);
Route::get('/groups/{id}/chat', [GroupController::class, 'chat']);
Route::post('/groups/{id}/send', [GroupController::class, 'sendMessage']);

Route::get('/tasks/trash', [TaskController::class, 'trash'])->name('tasks.trash');
Route::get('/tasks/restore/{id}', [TaskController::class, 'restore'])->name('tasks.restore');
Route::get('/tasks/assigned', [TaskController::class, 'assignedTasks'])->name('tasks.assigned');
Route::put('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::get('/tasks/{task}/comments', [TaskCommentController::class, 'index'])->name('tasks.comments');
Route::post('/tasks/{task}/comments', [TaskCommentController::class, 'store'])->name('tasks.comments.store');
Route::get('/task-comments', [TaskCommentController::class, 'allComments'])->name('task-comments');
Route::get('/task-attachments', [TaskAttachmentController::class, 'index'])->name('task.attachments');
Route::post('/task-attachments/upload', [TaskAttachmentController::class, 'store'])->name('task.attachments.store');

Route::resource('tasks', TaskController::class);

Route::get('/project-files-download/{id}', [ProjectFileController::class, 'download'])->name('project-files.download');
Route::get('/project-files-preview/{id}', [ProjectFileController::class, 'preview'])->name('project-files.preview');
Route::get('/project-files-trash', [ProjectFileController::class, 'trash'])->name('project-files.trash');
Route::post('/project-files-restore/{id}', [ProjectFileController::class, 'restore'])->name('project-files.restore');
Route::post('/project-files-version/{id}', [ProjectFileController::class, 'uploadNewVersion'])->name('project-files.version');
Route::get('/project-files-version-form/{id}', [ProjectFileController::class, 'versionForm'])->name('project-files.version.form');
Route::resource('project-files', ProjectFileController::class);

Route::get('/test-email', function () {

    Mail::raw('Congratulations! Laravel Email is working successfully.', function ($message) {
        $message->to('bdev2304@gmail.com')
            ->subject('Laravel Test Email');
    });

    return 'Test Email Sent Successfully!';
});

Route::get(
    '/admin/login-history',
    [LoginHistoryController::class, 'index']
)->name('admin.login-history');

Route::get('/admin/dashboard/tasks/filter', [AdminDashboardController::class, 'taskFilter'])
    ->name('admin.dashboard.task.filter');

Route::get('/admin/dashboard/revenue/filter', [AdminDashboardController::class, 'revenueFilter'])
    ->name('admin.dashboard.revenue.filter');



Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/meetings', [MeetingController::class, 'index'])
            ->name('meetings.index');

        Route::get('/meetings/create', [MeetingController::class, 'create'])
            ->name('meetings.create');

        Route::post('/meetings', [MeetingController::class, 'store'])
            ->name('meetings.store');

        Route::get('/meetings/{meeting}', [MeetingController::class, 'show'])
            ->name('meetings.show');

        Route::get('/meetings/{meeting}/edit', [MeetingController::class, 'edit'])
            ->name('meetings.edit');

        Route::put('/meetings/{meeting}', [MeetingController::class, 'update'])
            ->name('meetings.update');

        Route::delete('/meetings/{meeting}', [MeetingController::class, 'destroy'])
            ->name('meetings.destroy');

        Route::get('/meetings-upcoming', [MeetingController::class, 'upcoming'])
            ->name('meetings.upcoming');

        Route::get('/meetings-previous', [MeetingController::class, 'previous'])
            ->name('meetings.previous');

        Route::get('/meetings/{meeting}/join', [MeetingController::class, 'join'])
            ->name('meetings.join');
    });

Route::middleware(['auth', 'employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {

        Route::get('/meetings/create', [MeetingController::class, 'create'])
            ->name('meetings.create');

        Route::post('/meetings/store', [MeetingController::class, 'store'])
            ->name('meetings.store');

        Route::get('/my-meetings', [MeetingController::class, 'myMeetings'])
            ->name('meetings.my');
    });

Route::middleware(['auth', 'client'])
    ->prefix('client')
    ->name('client.')
    ->group(function () {

        Route::get('/meetings/create', [MeetingController::class, 'create'])
            ->name('meetings.create');

        Route::post('/meetings/store', [MeetingController::class, 'store'])
            ->name('meetings.store');

        Route::get('/my-meetings', [MeetingController::class, 'myMeetings'])
            ->name('meetings.my');
    });

Route::middleware(['auth', 'freelancer'])
    ->prefix('freelancer')
    ->name('freelancer.')
    ->group(function () {

        Route::get('/meetings/create', [MeetingController::class, 'create'])
            ->name('meetings.create');

        Route::post('/meetings/store', [MeetingController::class, 'store'])
            ->name('meetings.store');

        Route::get('/my-meetings', [MeetingController::class, 'myMeetings'])
            ->name('meetings.my');
    });


Route::middleware(['auth'])->group(function () {

    Route::get(
        '/tasks/{task}/checklist',
        [TaskChecklistController::class, 'index']
    )->name('tasks.checklist');

    Route::post(
        '/tasks/{task}/checklist',
        [TaskChecklistController::class, 'store']
    )->name('tasks.checklist.store');
    Route::post(
        '/tasks/{task}/checklist/update',
        [TaskChecklistController::class, 'update']
    )->name('tasks.checklist.update');
});


require __DIR__ . '/auth.php';

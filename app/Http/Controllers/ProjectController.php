<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectMember;
use App\Models\ActivityLog;
use App\Mail\ProjectAssignedMail;
use App\Mail\ProjectStatusUpdatedMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\NotificationController;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $clients = User::where('role', 'client')
            ->orderBy('name')
            ->get();

        return view('projects.create', compact('clients'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        $clients = User::where('role', 'client')
            ->orderBy('name')
            ->get();

        return view('projects.edit', compact('project', 'clients'));
    }
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $oldStatus = $project->status;
        $project->update([

            'title'             => $request->title,
            'client_id'         => $request->client_id,
            'description'       => $request->description,
            'service_location'  => $request->service_location,
            'nature_of_work'    => $request->nature_of_work,
            'start_date'        => $request->start_date,
            'deadline'          => $request->deadline,
            'budget'            => $request->budget,
            'billing_address'   => $request->billing_address,
            'status'            => $request->status,
            'invoice_status'    => $request->invoice_status,
            'payment_status'    => $request->payment_status,

        ]);

$project->refresh()->load('client');

if ($oldStatus != $project->status) {

    NotificationController::createNotification(
    $project->client_id,
    'Project Status Updated',
    'Project "' . $project->title . '" status changed to ' . $project->status,
    'project',
    route('projects.index'),
    'fas fa-folder-open',
    'success'
);
    Mail::to($project->client->email)
        ->send(new ProjectStatusUpdatedMail($project));
}
        return redirect('/admin/project-monitoring')
            ->with('success', 'Project Updated Successfully');
    }
    public function store(Request $request)
    {
        Project::create([

            'title'             => $request->title,
            'client_id'         => $request->client_id,
            'description'       => $request->description,
            'service_location'  => $request->service_location,
            'nature_of_work'    => $request->nature_of_work,
            'start_date'        => $request->start_date,
            'deadline'          => $request->deadline,
            'budget'            => $request->budget,
            'billing_address'   => $request->billing_address,
            'status'            => $request->status,
            'invoice_status'    => $request->invoice_status,
            'payment_status'    => $request->payment_status,

        ]);
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Created Project : ' . $request->title,
        ]);
        return redirect('/admin/project-monitoring')
            ->with('success', 'Project Created Successfully');
    }
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        return redirect('/admin/project-monitoring')
            ->with('success', 'Project Deleted Successfully');
    }

    public function team($id)
    {
        $project = Project::findOrFail($id);

        $users = User::whereIn('role', ['employee', 'freelancer'])->get();

        return view('projects.team', compact('project', 'users'));
    }

    public function storeTeam(Request $request)
    {
        $exists = ProjectMember::where('project_id', $request->project_id)
            ->where('user_id', $request->user_id)
            ->exists();

        if ($exists) {

            return back()->with(
                'error',
                'Team Member Already Assigned.'
            );
        }

        ProjectMember::create([

            'project_id' => $request->project_id,

            'user_id' => $request->user_id,

        ]);
        $project = Project::findOrFail($request->project_id);

        $user = User::findOrFail($request->user_id);

        Mail::to($user->email)->send(
            new ProjectAssignedMail($project, $user)
        );

        return back()->with(
            'success',
            'Team Member Assigned Successfully.'
        );
    }

    public function timeline()
    {
        $projects = Project::all();

        return view('projects.timeline', compact('projects'));
    }

    public function restore($id)
    {
        Project::withTrashed()
            ->findOrFail($id)
            ->restore();

        return redirect('/projects');
    }
    public function trash()
    {
        $projects = Project::onlyTrashed()->get();

        return view('projects.trash', compact('projects'));
    }

    public function progress()
    {
        $projects = Project::all();
        return view('projects.progress', compact('projects'));
    }
}

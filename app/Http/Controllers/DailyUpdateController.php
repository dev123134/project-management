<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DailyUpdate;
use App\Models\Project;
use App\Models\ActivityLog;

class DailyUpdateController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {

            $updates = DailyUpdate::latest()->get();
        } elseif ($user->role == 'client') {

            $updates = DailyUpdate::whereHas('project', function ($q) use ($user) {
                $q->where('client_id', $user->id);
            })->latest()->get();
        } else {

            $updates = DailyUpdate::whereHas('project.members', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->latest()->get();
        }

        return view('daily_updates.index', compact('updates'));
    }


    public function create()
    {
        if (Auth::user()->role == 'admin') {

            $projects = Project::all();
        } elseif (Auth::user()->role == 'client') {

            $projects = Project::where('client_id', Auth::id())->get();
        } else {

            $projects = Project::whereHas('members', function ($q) {
                $q->where('user_id', Auth::id());
            })->get();
        }

        return view('daily_updates.create', compact('projects'));
    }


    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'freelancer'])) {
            abort(403);
        }

        DailyUpdate::create([
            'project_id' => $request->project_id,
            'user_id' => Auth::id(),
            'work_update' => $request->work_update,
            'work_date' => $request->work_date,
        ]);
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Added Daily Update : ' . $request->work_update,
        ]);
        return redirect('/daily-updates')
            ->with('success', 'Daily Update Added Successfully');
    }
}

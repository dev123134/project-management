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
        $updates = DailyUpdate::latest()->get();

        return view('daily_updates.index', compact('updates'));
    }


    public function create()
    {
        $projects = Project::all();

        return view('daily_updates.create', compact('projects'));
    }


    public function store(Request $request)
    {
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

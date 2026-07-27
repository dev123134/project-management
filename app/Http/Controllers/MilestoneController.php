<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectMember;


class MilestoneController extends Controller
{
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

        return view('milestones.create', compact('projects'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        Milestone::create($request->all());

        return redirect('/milestones')
            ->with('success', 'Milestone Added Successfully');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {

            $milestones = Milestone::all();
        } elseif ($user->role == 'client') {

            $milestones = Milestone::whereHas('project', function ($q) use ($user) {
                $q->where('client_id', $user->id);
            })->get();
        } else {

            $milestones = Milestone::whereHas('project.members', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->get();
        }

        return view('milestones.index', compact('milestones'));
    }
}

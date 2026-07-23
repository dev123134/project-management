<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function create()
    {
        $projects = Project::all();

        return view('milestones.create', compact('projects'));
    }

    public function store(Request $request)
    {
        Milestone::create($request->all());

        return redirect('/milestones')
            ->with('success', 'Milestone Added Successfully');
    }

    public function index()
    {
        $milestones = Milestone::all();

        return view('milestones.index', compact('milestones'));
    }
}
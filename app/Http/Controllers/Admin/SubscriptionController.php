<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    // All Plans
    public function index()
    {
        $subscriptions = Subscription::latest()->get();

        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    // Add Plan Form
    public function create()
    {
        return view('admin.subscriptions.create');
    }

    // Save Plan
    public function store(Request $request)
    {
        $request->validate([
            'plan_name'         => 'required|max:255',
            'price'             => 'required|numeric',
            'duration'          => 'required|integer',
            'max_projects'      => 'required|integer',
            'max_team_members'  => 'required|integer',
            'storage_limit'     => 'required|max:100',
            'description'       => 'nullable',
            'status'            => 'required',
        ]);

        Subscription::create($request->all());

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('success', 'Subscription Plan Created Successfully.');
    }

    // Edit Form
    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);

        return view('admin.subscriptions.edit', compact('subscription'));
    }

    // Update Plan
    public function update(Request $request, $id)
    {
        $request->validate([
            'plan_name'         => 'required|max:255',
            'price'             => 'required|numeric',
            'duration'          => 'required|integer',
            'max_projects'      => 'required|integer',
            'max_team_members'  => 'required|integer',
            'storage_limit'     => 'required|max:100',
            'description'       => 'nullable',
            'status'            => 'required',
        ]);

        $subscription = Subscription::findOrFail($id);

        $subscription->update($request->all());

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('success', 'Subscription Plan Updated Successfully.');
    }

    // Delete Plan
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);

        $subscription->delete();

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('success', 'Subscription Plan Deleted Successfully.');
    }
}
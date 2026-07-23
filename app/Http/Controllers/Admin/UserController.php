<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }
    public function create()
{
    return view('admin.users.create');
}

public function store(StoreUserRequest $request)
{
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User created successfully.');
}
public function edit(User $user)
{
    return view('admin.users.edit', compact('user'));
}

public function update(UpdateUserRequest $request, User $user)
{
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;
    $user->status = $request->status;

    if ($request->filled('password')) {

        $user->password = Hash::make($request->password);

    }

    $user->save();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User updated successfully.');
}
public function destroy(User $user)
{
    
    if ($user->id == Auth::id()) {

        return redirect()
            ->back()
            ->with('error', 'You cannot delete your own account.');

    }

    $user->delete();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User moved to trash successfully.');
}
public function trash()
{
    $users = User::onlyTrashed()->latest()->get();

    return view('admin.users.trash', compact('users'));
}
public function restore($id)
{
    $user = User::onlyTrashed()->findOrFail($id);

    $user->restore();

    return redirect()
        ->route('admin.users.trash')
        ->with('success', 'User restored successfully.');
}
public function forceDelete($id)
{
    $user = User::onlyTrashed()->findOrFail($id);

   
    if ($user->id == Auth::id()) {
        return redirect()
            ->back()
            ->with('error', 'You cannot permanently delete your own account.');
    }

    $user->forceDelete();

    return redirect()
        ->route('admin.users.trash')
        ->with('success', 'User permanently deleted successfully.');
}
public function block($id)
{
    $user = User::findOrFail($id);

    // Admin પોતાને Block ન કરી શકે
    if ($user->id == Auth::id()) {

        return redirect()
            ->back()
            ->with('error', 'You cannot block your own account.');

    }

    $user->status = 'inactive';

    $user->save();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User blocked successfully.');
}

public function unblock($id)
{
    $user = User::findOrFail($id);

    $user->status = 'active';

    $user->save();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User unblocked successfully.');
}
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = LoginHistory::with('user');

        // Search by User Name
        if ($request->filled('search')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%');

            });

        }

        // Filter by Role
        if ($request->filled('role')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('role', $request->role);

            });

        }

        // Filter by Login Date
        if ($request->filled('date')) {

            $query->whereDate('login_at', $request->date);

        }
                $loginHistories = $query
            ->latest('login_at')
            ->paginate(10);

        // Dashboard Summary
        $totalLogins = LoginHistory::count();

        $onlineUsers = LoginHistory::whereNull('logout_at')->count();

        $todayLogins = LoginHistory::whereDate('login_at', today())->count();

        $totalAdmins = LoginHistory::whereHas('user', function ($q) {

            $q->where('role', 'admin');

        })->count();

        return view(
            'admin.login-history.index',
            compact(
                'loginHistories',
                'totalLogins',
                'onlineUsers',
                'todayLogins',
                'totalAdmins'
            )
        );
    }
}
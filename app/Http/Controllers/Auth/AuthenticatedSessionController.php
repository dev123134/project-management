<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\LoginHistory;
use Jenssegers\Agent\Agent;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        if (Auth::user()->status == 'inactive') {

            Auth::logout();

            return back()->withErrors([
                'email' => 'Your account has been blocked by Administrator.',
            ])->onlyInput('email');
        }
        $request->session()->regenerate();
        $agent = new Agent();

        LoginHistory::create([

            'user_id'    => Auth::id(),

            'ip_address' => $request->ip(),

            'browser'    => $agent->browser(),

            'os'         => $agent->platform(),

            'login_at'   => now(),

        ]);
        if (Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        } elseif (Auth::user()->role == 'freelancer') {
            return redirect('/freelancer/dashboard');
        } elseif (Auth::user()->role == 'employee') {
            return redirect('/employee/dashboard');
        } else {
            return redirect('/client/dashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        LoginHistory::where('user_id', Auth::id())
            ->whereNull('logout_at')
            ->latest()
            ->first()?->update([

                'logout_at' => now(),

            ]);
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}

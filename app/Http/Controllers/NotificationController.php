<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
   public function index()
{
    $notifications = Notification::where(
        'user_id',
        Auth::id()
    )->latest()->get();

    return view(
        'notifications.index',
        compact('notifications')
    );
}

    public function markRead($id)
    {
        $notification = Notification::findOrFail($id);

        $notification->update([
            'is_read' => true
        ]);

        return back();
    }
}

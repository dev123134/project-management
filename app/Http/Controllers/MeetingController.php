<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingParticipant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    /**
     * Display all meetings.
     */
    public function index()
    {
        $meetings = Meeting::with('creator')
            ->latest()
            ->paginate(10);

        return view('meetings.index', compact('meetings'));
    }

    /**
     * Show create meeting form.
     */
    public function create()
    {
        $users = User::where('status', 'active')
            ->where('id', '!=', Auth::id())
            ->orderBy('name')
            ->get();

        return view('meetings.create', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'meeting_title'       => 'required|string|max:255',
            'meeting_description' => 'nullable|string',
            'meeting_link'        => 'nullable|url',
            'meeting_password'    => 'nullable|string|max:255',
            'meeting_date' => 'required|date|after_or_equal:today',
            'meeting_time'        => 'required',
            'duration'            => 'required|integer',
            'participants'        => 'required|array|min:1',
            'participants.*'      => 'exists:users,id',
        ]);

        $meeting = Meeting::create([

            'meeting_title'       => $request->meeting_title,
            'meeting_description' => $request->meeting_description,
            'meeting_link'        => $request->meeting_link,
            'meeting_password'    => $request->meeting_password,
            'meeting_date'        => $request->meeting_date,
            'meeting_time'        => $request->meeting_time,
            'duration'            => $request->duration,
            'created_by'          => Auth::id(),
            'status'              => 'upcoming',

        ]);

        foreach ($request->participants as $userId) {

            MeetingParticipant::create([

                'meeting_id' => $meeting->id,
                'user_id' => $userId,
                'attendance_status' => 'pending',

            ]);
        }

        return redirect()
            ->route('admin.meetings.index')
            ->with('success', 'Meeting scheduled successfully.');
    }

    public function show(Meeting $meeting)
    {
        $meeting->load([
            'creator',
            'participants.user'
        ]);

        return view('meetings.show', compact('meeting'));
    }

    public function edit(Meeting $meeting)
    {
        $users = User::where('status', 'active')
            ->whereIn('role', ['employee', 'freelancer', 'client'])
            ->orderBy('name')
            ->get();

        $selectedParticipants = $meeting->participants
            ->pluck('user_id')
            ->toArray();

        return view(
            'meetings.edit',
            compact(
                'meeting',
                'users',
                'selectedParticipants'
            )
        );
    }

    /**
     * Update meeting.
     */
    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'meeting_title'       => 'required|string|max:255',
            'meeting_description' => 'nullable|string',
            'meeting_link'        => 'nullable|url',
            'meeting_password'    => 'nullable|string|max:255',
            'meeting_date' => 'required|date|after_or_equal:today',
            'meeting_time'        => 'required',
            'duration'            => 'required|integer',
            'participants'        => 'required|array|min:1',
            'participants.*'      => 'exists:users,id',
        ]);

        $meeting->update([

            'meeting_title'       => $request->meeting_title,
            'meeting_description' => $request->meeting_description,
            'meeting_link'        => $request->meeting_link,
            'meeting_password'    => $request->meeting_password,
            'meeting_date'        => $request->meeting_date,
            'meeting_time'        => $request->meeting_time,
            'duration'            => $request->duration,

        ]);

        // Remove old participants
        MeetingParticipant::where('meeting_id', $meeting->id)->delete();

        // Add new participants
        foreach ($request->participants as $userId) {

            MeetingParticipant::create([

                'meeting_id' => $meeting->id,
                'user_id' => $userId,
                'attendance_status' => 'pending',

            ]);
        }

        return redirect()
            ->route('admin.meetings.index')
            ->with('success', 'Meeting updated successfully.');
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();

        return redirect()
            ->route('admin.meetings.index')
            ->with('success', 'Meeting deleted successfully.');
    }


    public function upcoming() {}


    public function previous() {}


    public function join(Meeting $meeting) {}


    public function myMeetings()
    {
        $meetings = Meeting::with('creator')
            ->whereHas('participants', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('meeting_date', 'asc')
            ->orderBy('meeting_time', 'asc')
            ->paginate(10);

        return view('meetings.my-meetings', compact('meetings'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'user_id',
        'joined_at',
        'left_at',
        'attendance_status',
    ];

    /**
     * Meeting
     */
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    /**
     * Participant User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
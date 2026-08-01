<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'meeting_title',
        'meeting_description',
        'meeting_link',
        'meeting_password',
        'meeting_date',
        'meeting_time',
        'duration',
        'created_by',
        'status',
    ];

    /**
     * Meeting Creator (Host)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Meeting Participants
     */
    public function participants()
    {
        return $this->hasMany(MeetingParticipant::class);
    }
}
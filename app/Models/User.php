<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'status',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getMaskedEmailAttribute()
{
    $parts = explode('@', $this->email);

    $name = substr(
        $parts[0],
        0,
        2
    );

    return $name .
           str_repeat(
               '*',
               strlen($parts[0]) - 2
           )
           . '@' .
           $parts[1];
}
public function uploadedFiles()
{
    return $this->hasMany(ProjectFile::class, 'uploaded_by');
}

public function meetingsCreated()
{
    return $this->hasMany(Meeting::class, 'created_by');
}


public function meetingParticipants()
{
    return $this->hasMany(MeetingParticipant::class);
}


public function invoices()
{
    return $this->hasMany(Invoice::class, 'created_by');
}

public function receivedPayments()
{
    return $this->hasMany(Payment::class, 'received_by');
}

public function projects()
{
    return $this->belongsToMany(
        Project::class,
        'project_members'
    );
}

public function dailyUpdates()
{
    return $this->hasMany(DailyUpdate::class);
}


}

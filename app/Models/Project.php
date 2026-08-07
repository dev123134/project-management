<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Milestone;
use App\Models\ProjectMember;
use App\Models\DailyUpdate;
use App\Models\ActivityLog;
use App\Models\User;


class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

   protected $fillable = [
    'title',
    'client_id',
    'description',
    'service_location',
    'nature_of_work',
    'start_date',
    'deadline',
    'budget',
    'billing_address',
    'status',
    'invoice_status',
    'payment_status',
];
    public function files()
{
    return $this->hasMany(ProjectFile::class);
}
public function milestones()
{
    return $this->hasMany(Milestone::class);
}
public function client()
{
    return $this->belongsTo(User::class, 'client_id');
}
public function members()
{
    return $this->hasMany(ProjectMember::class);
}

public function dailyUpdates()
{
    return $this->hasMany(DailyUpdate::class);
}


public function getProgressAttribute()
{
    $total = $this->milestones()->count();

    $completed = $this->milestones()
        ->where('status', 'Completed')
        ->count();

    return $total > 0
        ? round(($completed / $total) * 100)
        : 0;
}

public function invoices()
{
    return $this->hasMany(Invoice::class);
}


}

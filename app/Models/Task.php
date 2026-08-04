<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
    'project_id',
    'assigned_by',
    'assigned_to',
    'title',
    'description',
    'priority',
    'due_date',
    'status',
    'github_link',
    'assigned_date',
];

public function project()
{
    return $this->belongsTo(Project::class);
}

public function assigner()
{
    return $this->belongsTo(User::class,'assigned_by');
}

public function assignee()
{
    return $this->belongsTo(User::class,'assigned_to');
}
public function comments()
{
    return $this->hasMany(TaskComment::class);
}
public function attachments()
{
    return $this->hasMany(TaskAttachment::class);
}
}

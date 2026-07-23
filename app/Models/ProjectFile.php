<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'uploaded_by',
        'file_name',
        'original_name',
        'file_type',
        'file_size',
        'file_path',
        'version',
        'description'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
    public function versions()
    {
        return $this->hasMany(FileVersion::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileVersion extends Model
{
    protected $fillable = [
        'project_file_id',
        'uploaded_by',
        'version',
        'file_path',
        'file_size'
    ];
     public function projectFile()
    {
        return $this->belongsTo(ProjectFile::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
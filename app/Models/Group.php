<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GroupMessage;
use App\Models\GroupMember;



class Group extends Model
{
    protected $fillable = [
        'name',
    ];

    public function messages()
{
    return $this->hasMany(GroupMessage::class);
}

public function members()
{
    return $this->hasMany(GroupMember::class);
}
}

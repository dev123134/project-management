<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{

    use SoftDeletes;
    
    protected $fillable = [

        'plan_name',
        'price',
        'duration',
        'max_projects',
        'max_team_members',
        'storage_limit',
        'description',
        'status',

    ];
}
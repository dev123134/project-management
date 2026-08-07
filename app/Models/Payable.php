<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{
    use HasFactory;

    protected $fillable = [

        'payable_number',

        'payable_type',

        'vendor_name',

        'amount',

        'payment_date',

        'due_date',

        'status',

        'notes',

        'created_by',

    ];

    /**
     * User who created this payable
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
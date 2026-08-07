<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\InvoiceItem;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'po_date',
        'po_number',
        'subtotal',
        'tax_percentage',
        'tax_amount',
        'discount',
        'grand_total',
        'status',
        'notes',
        'created_by',
    ];

    // Invoice belongs to Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Invoice created by User
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Invoice has many Items
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

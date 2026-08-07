<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [

        'invoice_id',

        'description',

        'hsn_code',

        'quantity',

        'unit',

        'unit_price',

        'tax_percentage',

        'tax_amount',

        'total',

    ];

    /**
     * Get the Invoice that owns this Item.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
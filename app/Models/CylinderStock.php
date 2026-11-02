<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToAgency;

class CylinderStock extends Model
{
    use BelongsToAgency;

    protected $fillable = [
        'type',
        'quantity',
        'unit_price',
        'total_cost',
        'transaction_date',
        'supplier_name',
        'note',
        'agency_id',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'transaction_date' => 'date',
    ];
}

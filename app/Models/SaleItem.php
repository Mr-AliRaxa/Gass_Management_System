<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToAgency;

class SaleItem extends Model
{
    use BelongsToAgency;

    protected $fillable = [
        'sale_id',
        'type',
        'quantity',
        'price',
        'agency_id',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}

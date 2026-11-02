<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToAgency;

class Sale extends Model
{
    use BelongsToAgency;

    protected $fillable = [
        'customer_id',
        'date',
        'total_amount',
        'agency_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}

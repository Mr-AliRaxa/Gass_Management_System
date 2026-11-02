<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToAgency;

class Customer extends Model
{
    use BelongsToAgency;

    protected $fillable = [
        'name',
        'mobile',
        'address',
        'distance',
        'profile_pic',
        'id_card_front',
        'id_card_back',
        'agency_id',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}

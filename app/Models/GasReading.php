<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToAgency;

class GasReading extends Model
{
    use BelongsToAgency;

    protected $fillable = [
        'date',
        'start_reading',
        'start_image',
        'end_reading',
        'end_image',
        'agency_id',
    ];
}

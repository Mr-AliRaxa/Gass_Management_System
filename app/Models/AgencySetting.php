<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToAgency;

class AgencySetting extends Model
{
    use BelongsToAgency;

    protected $fillable = ['agency_id', 'letterhead', 'top_margin', 'bottom_margin', 'logo'];
}

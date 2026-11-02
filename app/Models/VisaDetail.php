<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToAgency;

class VisaDetail extends Model
{
    use BelongsToAgency;

    protected $fillable = [
        'team_member_id',
        'issue_date',
        'expiry_date',
        'agency_id',
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }
}

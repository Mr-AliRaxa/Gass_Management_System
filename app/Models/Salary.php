<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TeamMember;

use App\Traits\BelongsToAgency;

class Salary extends Model
{
    use BelongsToAgency;

    protected $fillable = [
        'team_member_id',
        'amount',
        'bonus',
        'date',
        'salary_slip',
        'note',
        'agency_id',
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }
}

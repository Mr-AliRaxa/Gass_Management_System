<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToAgency;

class Attendance extends Model
{
    use BelongsToAgency;

    protected $fillable = [
        'team_member_id',
        'date',
        'status',
        'note',
        'agency_id',
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }
}

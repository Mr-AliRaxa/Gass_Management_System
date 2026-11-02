<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToAgency;

class TeamMember extends Model
{
    use BelongsToAgency;

    protected $fillable = [
        'name',
        'mobile',
        'address',
        'designation',
        'basic_salary',
        'profile_pic',
        'id_card_front',
        'id_card_back',
        'agency_id',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function visaDetails()
    {
        return $this->hasMany(VisaDetail::class);
    }
}

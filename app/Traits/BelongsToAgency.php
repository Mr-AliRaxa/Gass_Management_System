<?php

namespace App\Traits;

use App\Models\Agency;
use App\Models\Scopes\AgencyScope;
use Illuminate\Support\Facades\Auth;

trait BelongsToAgency
{
    protected static function booted()
    {
        static::addGlobalScope(new AgencyScope);

        static::creating(function ($model) {
            if (Auth::check() && !$model->agency_id) {
                $model->agency_id = Auth::user()->agency_id;
            }
        });
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}

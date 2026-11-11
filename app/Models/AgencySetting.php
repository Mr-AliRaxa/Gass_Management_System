<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToAgency;

class AgencySetting extends Model
{
    use BelongsToAgency;

    protected $fillable = ['agency_id', 'letterhead', 'is_letterhead_active', 'top_margin', 'bottom_margin', 'logo'];

    protected $casts = [
        'is_letterhead_active' => 'boolean',
    ];

    /**
     * Check if letterhead is available and active
     */
    public function hasActiveLetterhead(): bool
    {
        return !empty($this->letterhead) && (bool) $this->is_letterhead_active;
    }
}

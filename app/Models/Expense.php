<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToAgency;

class Expense extends Model
{
    use BelongsToAgency;

    protected $fillable = [
        'expense_type_id',
        'amount',
        'date',
        'slip_image',
        'note',
        'agency_id',
    ];

    public function type()
    {
        return $this->belongsTo(ExpenseType::class, 'expense_type_id');
    }
}

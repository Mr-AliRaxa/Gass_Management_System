<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Expense;

use App\Traits\BelongsToAgency;

class ExpenseType extends Model
{
    use BelongsToAgency;

    protected $fillable = ['name', 'agency_id'];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
